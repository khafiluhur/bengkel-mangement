<?php

namespace App\Controllers;

use App\Models\CheckInsModel;
use App\Models\CheckOutsModel;
use App\Controllers\BaseController;
use App\Models\CustomersModel;
use App\Models\MontirsModel;
use App\Models\CheckInItemsModel;
use App\Models\CardStocksModel;
use App\Models\ItemsModel;
use App\Models\SuppliersModel;
use DB;

class Transaction extends BaseController
{

    public function __construct()
    {

        $this->db = db_connect(); // Loading database
        // OR $this->db = \Config\Database::connect();
        $this->checkInModel = new CheckInsModel();
        $this->checkOutModel = new CheckOutsModel();
        $this->checkInItemsModel = new CheckInItemsModel();

        $this->customerModel = new CustomersModel();
        $this->montirsModel = new MontirsModel();

        $this->itemModel = new ItemsModel();
        $this->supplierModel = new SuppliersModel();
    }

    public function index()
    {
        //
    }

    public function checkIn()
    {
        $transactions = $this->checkInModel->findAll();
        
        $items = $this->itemModel->findAll();
        $suppliers = $this->supplierModel->findAll();

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = [
            'title' => 'Transaksi Barang Masuk',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'checkIns',
            'transactions' => $transactions,
            'items' => $items,
            'suppliers' => $suppliers
        ];

        return view('pages/transaction', $data);
    }

    public function detailCheckIn($id)
    {
        $builder = $this->db->table("check_ins");
        $builder->select('check_ins.*');
        $builder->where('code_order', $id);
        $transactions = $builder->get()->getResult();
        // Supplier //
        $suppliers = $this->supplierModel->findAll();

        $items = $this->itemModel->findAll();

        $builder = $this->db->table("check_in_items");
        $builder->select('check_in_items.*, items.name as nama_item, items.code as code_item, items.stock as stock_item, suppliers.name as name_supplier, suppliers.code as code_supplier, suppliers.id_supplier as id_supplier');
        $builder->join('items', 'check_in_items.id_item = items.id_item');
        $builder->join('suppliers', 'check_in_items.id_supplier = suppliers.id_supplier');
        $builder->where('check_in_items.code_order', $transactions[0]->code_order);
        $itemPrice = $builder->get()->getResult();

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();
        
        $data = [
            'title' => 'Detail Transaksi Masuk',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'checkIns',
            'item_supplier' => $itemPrice,
            'transactions' => $transactions,
            'items' => $items,
            'suppliers' => $suppliers
        ];
        // dd($data);
        return view('pages/transaction_supplier/detail', $data);
    }

    public function storeCheckIn()
    {
        $transactions = $this->checkInModel->findAll();
        $items = $this->itemModel->findAll();
        $suppliers = $this->supplierModel->findAll();
        
        //Generate Code Items
        $count = count($transactions);
        if($count == 0) {
            $var = 1;
        } else {
            $var = $count + 1;
        }
        $generate_code = sprintf('%05d', $var);

        $builder = $this->db->table("check_in_items");
        $builder->select('check_in_items.*, items.name as nama_item, items.code as code_item, items.stock as stock_item, suppliers.name as name_supplier, suppliers.code as code_supplier, suppliers.id_supplier as id_supplier');
        $builder->join('items', 'check_in_items.id_item = items.id_item');
        $builder->join('suppliers', 'check_in_items.id_supplier = suppliers.id_supplier');
        $builder->where('check_in_items.code_order', 'TRIN'.$generate_code);
        $itemPrice = $builder->get()->getResult();

        $builder = $this->db->table("check_in_items");
        $builder->select('sum(subtotal) as total_pay');
        $builder->where('code_order', 'TRIN'.$generate_code);
        $total_pay = $builder->get()->getResult();

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = [
            'title' => 'Tambah Transaksi',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'checkIns',
            'new_code' => 'TRIN'.$generate_code,
            'items' => $items,
            'item_supplier' => $itemPrice,
            'total_pay' => $total_pay,
            'suppliers' => $suppliers,
        ];

        return view('pages/transaction_supplier/create', $data);
    }

    public function createCheckIn()
    {
        if (!$this->validate([
            'code' => [

            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('check_in'));
        }

        $builder = $this->db->table("check_in_items");
        $builder->select('sum(subtotal) as total_pay');
        $builder->where('code_order', $this->request->getPost('code'));
        $total_pay = $builder->get()->getResult();

        if($total_pay[0]->total_pay == null) {
            session()->setFlashdata('error', 'Harus memilih barang terlebih dahulu');
            return redirect()->to(base_url('check_in/store'));
        } else {
            $item = new CheckInsModel();
            $item->insert([
                'code_order' => $this->request->getPost('code'),
                'date_trasanction' => date("Y-m-d"),
                'total_pay' => $total_pay[0]->total_pay,
                'created_at' => date("Y-m-d H:i:s"),
                'created_by' => session()->get('username'),
                'updated_at' => date("Y-m-d H:i:s"),
                'updated_by' => session()->get('username')
            ]);
        }
        
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('check_in'));
    }

    public function updateCheckIn($id)
    {
        //Check Item Check In
        $builder = $this->db->table("check_in_items");
        $builder->select('*');
        $builder->where('check_in_items.id', $id);
        $idItems = $builder->get()->getResult();
        
        $convertToArray = explode(' ', $this->request->getPost('price'));
        $slicedToArray = explode('.', $convertToArray[1]);
        $joinToArray = join("",$slicedToArray);

        $builder = $this->db->table("items");
        $builder->select('stock');
        $builder->where('id_item', $idItems[0]->id_item);
        $itemPrice = $builder->get()->getResult();
        $stockItems = $itemPrice[0]->stock;

        $stockNewItem = $this->db->table("check_in_items");
        $stockNewItem->select('stock');
        $stockNewItem->where('id', $id);
        $itemStock = $stockNewItem->get()->getResult();
        $stockNewItems = $itemStock[0]->stock;

        $items = new CheckInItemsModel();
        $items->update($id, [
            'price' => $joinToArray,
            'id_supplier' => $this->request->getPost('id_supplier'),
            'stock' => $this->request->getPost('total_stock'),
            'subtotal' =>  $joinToArray * $this->request->getPost('total_stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);

        // balance stock
        $save_items = new ItemsModel();
        $save_items->update($idItems[0]->id_item, [
            'stock' =>  ($stockItems - $stockNewItems) + $this->request->getPost('total_stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('check_in/store'));
    }

    public function updateDetailCheckIn($id)
    {
        //Check Item Check In
        $builder = $this->db->table("check_in_items");
        $builder->select('check_in_items.*, check_ins.id as id_check_ins');
        $builder->join('check_ins', 'check_in_items.code_order = check_ins.code_order');
        $builder->where('check_in_items.id', $id);
        $idItems = $builder->get()->getResult();
        
        $convertToArray = explode(' ', $this->request->getPost('price'));
        $slicedToArray = explode('.', $convertToArray[1]);
        $joinToArray = join("",$slicedToArray);

        $builder = $this->db->table("items");
        $builder->select('stock');
        $builder->where('id_item', $idItems[0]->id_item);
        $itemPrice = $builder->get()->getResult();
        $stockItems = $itemPrice[0]->stock;

        $stockNewItem = $this->db->table("check_in_items");
        $stockNewItem->select('stock, subtotal');
        $stockNewItem->where('id', $id);
        $itemStock = $stockNewItem->get()->getResult();
        $stockNewItems = $itemStock[0]->stock;

        $priceNewItem = $this->db->table("check_ins");
        $priceNewItem->select('total_pay');
        $priceNewItem->where('code_order', $idItems[0]->code_order);
        $priceStock = $priceNewItem->get()->getResult();
        $priceNewItems = $priceStock[0]->total_pay;

        $items = new CheckInItemsModel();
        $items->update($id, [
            'price' => $joinToArray,
            'id_supplier' => $this->request->getPost('id_supplier'),
            'stock' => $this->request->getPost('total_stock'),
            'subtotal' =>  $joinToArray * $this->request->getPost('total_stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);

        // Update Card Stock Saldo In
        $checkInItemSame1 = $this->db->table("card_stocks");
        $checkInItemSame1->select('id');
        $checkInItemSame1->like('information', $idItems[0]->code_order);
        $checkInItemSame = $checkInItemSame1->get()->getResult();
        foreach($checkInItemSame as $key => $item) {
            $checkInItemSame = $item->id;
        }
        $cardStocks = new CardStocksModel();
        $cardStocks->update($checkInItemSame, [
            'stock_in' => $this->request->getPost('total_stock'),
            'saldo' => ($stockItems - $stockNewItems) + $this->request->getPost('total_stock'),
        ]);

        // balance price
        $price_items = new CheckInsModel();
        $price_items->update($idItems[0]->id_check_ins, [
            'total_pay' =>  ($priceNewItems - $itemStock[0]->subtotal) + ($joinToArray * $this->request->getPost('total_stock')),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);

        // balance stock
        $save_items = new ItemsModel();
        $save_items->update($idItems[0]->id_item, [
            'stock' =>  ($stockItems - $stockNewItems) + $this->request->getPost('total_stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->back();
    }

    public function deleteCheckIn($id)
    {
        $builder = $this->db->table("check_ins");
        $builder->select('check_ins.*');
        $builder->where('code_order', $id);
        $items = $builder->get()->getResult();

        // Check Item Supplier //
        $builder = $this->db->table("check_in_items");
        $builder->select('check_in_items.*');
        $builder->where('code_order', $items[0]->code_order);
        $itemSuppliers = $builder->get()->getResult();

        // Delete Card Stock Saldo In
        $checkInItemSame1 = $this->db->table("card_stocks");
        $checkInItemSame1->select('id');
        $checkInItemSame1->like('information', $items[0]->code_order);
        $checkInItemSame = $checkInItemSame1->get()->getResult();
        $array = [];
        foreach($checkInItemSame as $key => $item) {
            $array[$key] = $checkInItemSame[$key]->id;
            $cardStocks = new CardStocksModel();
            $cardStocks->delete($array[$key]);
        }

        foreach ($itemSuppliers as $item) {
            $builder = $this->db->table("items");
            $builder->select('items.*');
            $builder->where('id_item', $item->id_item);
            $itemSuppliers = $builder->get()->getResult();

            $save_items = new ItemsModel();
            $save_items->update($item->id_item, [
                'stock' =>  $itemSuppliers[0]->stock - $item->stock,
                'updated_at'  => date("Y-m-d H:i:s"),
                'updated_by'  => session()->get('username')
            ]);
        }

        $this->checkInItemsModel->where('code_order', $items[0]->code_order);
        $this->checkInItemsModel->delete();

        $this->checkInModel->where('code_order', $items[0]->code_order);
        $this->checkInModel->delete();
        
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('check_in'));
    }

    public function createCheckInItem()
    {
        if (!$this->validate([
            'id_item' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harus dipilih Nama Barang.',
                ],
            ],
            'price1' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harga Barang Harus diisi.',
                ],
            ],
            'id_supplier' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harus dipilih Supplier Barang.',
                ],
            ],
            'total_stock' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Stok Barang Harus diisi.',
                ],
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('check_in/store'));
        }

        //Check In Item in Same
        $checkInItemSame1 = $this->db->table("check_in_items");
        $checkInItemSame1->select('*');
        $checkInItemSame1->where('code_order', $this->request->getPost('codeTR'));
        $checkInItemSame1->where('id_item', $this->request->getPost('id_item'));
        $checkInItemSame = $checkInItemSame1->get()->getResult();

        if($checkInItemSame == null) {
            $convertToArray = explode(' ', $this->request->getPost('price1'));
            $slicedToArray = explode('.', $convertToArray[1]);
            $joinToArray = join("",$slicedToArray);

            // Sum Request stock equal Price
            $subtotal = $this->request->getPost('total_stock') * $joinToArray;

            $item = new CheckInItemsModel();
            $item->insert([
                'code_order' => $this->request->getPost('codeTR'),
                'id_item' => $this->request->getPost('id_item'),
                'id_supplier' => $this->request->getPost('id_supplier'),
                'price' => $joinToArray,
                'stock' => $this->request->getPost('total_stock'),
                'subtotal' => $subtotal,
                'created_at' => date("Y-m-d H:i:s"),
                'created_by' => session()->get('username'),
                'updated_at' => date("Y-m-d H:i:s"),
                'updated_by' => session()->get('username')
            ]);

            // Create Card Stock Saldo In
            $checkInItemSame1 = $this->db->table("items");
            $checkInItemSame1->select('code, stock');
            $checkInItemSame1->where('id_item', $this->request->getPost('id_item'));
            $checkInItemSame = $checkInItemSame1->get()->getResult();
            foreach($checkInItemSame as $key => $item) {
                $checkInItemSame = $item->code;
                $checkInItemStockSame = $item->stock;
            }
            $cardStocks = new CardStocksModel();
            $cardStocks->insert([
                'date' => date("Y-m-d"),
                'information' => $this->request->getPost('codeTR')." Barang Masuk",
                'id_item' => $checkInItemSame,
                'stock_in' => $this->request->getPost('total_stock'),
                'stock_out' => "",
                'saldo' => $checkInItemStockSame + $this->request->getPost('total_stock'),
            ]);

            // balace stock //
            $item1 = $this->db->table("items");
            $item1->select('stock');
            $item1->where('id_item', $this->request->getPost('id_item'));
            $itemPrice1 = $item1->get()->getResult();

            $items2 = $itemPrice1[0]->stock;

            $save_items = new ItemsModel();
            $save_items->update($this->request->getPost('id_item'), [
                'stock' =>  $items2 + $this->request->getPost('total_stock'),
                'updated_at'  => date("Y-m-d H:i:s"),
                'updated_by'  => session()->get('username')
            ]);

            session()->setFlashData('success', 'Berhasil ditambah');
        } else {
            session()->setFlashData('error', 'Barang yang ditambah sudah ada di transaksi ini, silakan ubah dengan cara mengeklik icon pencil');
        }

        return redirect()->to(base_url('check_in/store'));
    }

    public function deleteCheckInItem($id)
    {
        $stockNewItem = $this->db->table("check_in_items");
        $stockNewItem->select('stock, id_item, code_order');
        $stockNewItem->where('id', $id);
        $itemStock = $stockNewItem->get()->getResult();
        $stockNewItems = $itemStock[0]->stock;

        $builder = $this->db->table("items");
        $builder->select('stock, code');
        $builder->where('id_item', $itemStock[0]->id_item);
        $itemPrice = $builder->get()->getResult();
        $stockItems = $itemPrice[0]->stock;

        // Delete Card Stock Saldo In
        $checkInItemSame1 = $this->db->table("card_stocks");
        $checkInItemSame1->select('id');
        $checkInItemSame1->like('information', $itemPrice[0]->code);
        $checkInItemSame = $checkInItemSame1->get()->getResult();
       
        $array = [];
        foreach($checkInItemSame as $key => $item) {
            $array[$key] = $checkInItemSame[$key]->id;
            $cardStocks = new CardStocksModel();
            $cardStocks->delete($array[$key]);
        }

        // balance stock
        $save_items = new ItemsModel();
        $save_items->update($itemStock[0]->id_item, [
            'stock' =>  ($stockItems - $stockNewItems),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);

        $items = new CheckInItemsModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('check_in/store'));
    }

    public function checkOut()
    {
        $builder = $this->db->table("check_outs");
        $builder->select('check_outs.*, items.name as item, items.code as code_item, items.id_item as id_item');
        $builder->join('items', 'check_outs.id_item = items.id_item');
        $transactions = $builder->get()->getResult();

        $items = $this->itemModel->findAll();

        $data = [
            'title' => 'Transaksi Barang Keluar',
            'type' => 'checkOuts',
            'transactions' => $transactions,
            'items' => $items,
        ];
        return view('pages/transaction', $data);
    }

    public function createCheckOut()
    {
        if (!$this->validate([
            'id_item' => [

            ],
            'date_out' => [

            ],
            'stock' => [

            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('items'));
        }

        $convertToDate = explode(' ', $this->request->getPost('date_out'));

        $items = new CheckOutsModel();
        $items->insert([
            'id_item' => $this->request->getPost('id_item'),
            'date_out' => $convertToDate,
            'stock' => $this->request->getPost('stock'),
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => session()->get('username'),
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session()->get('username')
        ]);

        $builder = $this->db->table("items");
        $builder->select('stock');
        $builder->where('id_item', $this->request->getPost('id_item'));
        $itemPrice = $builder->get()->getResult();

        $items2 = $itemPrice[0]->stock;
        $save_items = new ItemsModel();
        $save_items->update($this->request->getPost('id_item'), [
            'stock' => $items2 - $this->request->getPost('stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('check_out'));
    }

    public function updateCheckOut($id)
    {
        $builder = $this->db->table("items");
        $builder->select('stock');
        $builder->where('id_item', $this->request->getPost('id_item'));
        $itemPrice = $builder->get()->getResult();
        $stockItems = $itemPrice[0]->stock;

        $stockNewItem = $this->db->table("check_outs");
        $stockNewItem->select('stock');
        $stockNewItem->where('id', $id);
        $itemStock = $stockNewItem->get()->getResult();
        $stockNewItems = $itemStock[0]->stock;

        $items = new CheckOutsModel();
        $items->update($id, [
            'id_item' => $this->request->getPost('id_item'),
            'date_out' => $this->request->getPost('date_out'),
            'stock' => $this->request->getPost('stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);

        // balance stock
        $save_items = new ItemsModel();
        $save_items->update($this->request->getPost('id_item'), [
            'stock' =>  ($stockItems + $stockNewItems) - $this->request->getPost('stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('check_out'));
    }

    public function deleteCheckOut($id)
    {
        $stockNewItem = $this->db->table("check_outs");
        $stockNewItem->select('stock, id_item');
        $stockNewItem->where('id', $id);
        $itemStock = $stockNewItem->get()->getResult();
        $stockNewItems = $itemStock[0]->stock;

        $builder = $this->db->table("items");
        $builder->select('stock');
        $builder->where('id_item', $itemStock[0]->id_item);
        $itemPrice = $builder->get()->getResult();
        $stockItems = $itemPrice[0]->stock;

        // Delete Card Stock Saldo In
        $checkInItemSame1 = $this->db->table("card_stocks");
        $checkInItemSame1->select('id');
        $checkInItemSame1->like('information', $itemStock[0]->code_order);
        $checkInItemSame = $checkInItemSame1->get()->getResult();
        foreach($checkInItemSame as $key => $item) {
            $checkInItemSame = $item->id;
        }
        $cardStocks = new CardStocksModel();
        $cardStocks->delete($checkInItemSame);

        // balance stock
        $save_items = new ItemsModel();
        $save_items->update($itemStock[0]->id_item, [
            'stock' =>  ($stockItems + $stockNewItems),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);

        $items = new CheckOutsModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('check_out'));
    }
}
