<?php
namespace App\Controllers;

use App\Models\ItemsModel;
use App\Models\ServiceModel;
use App\Models\OtherCostModel;
use App\Models\CheckSuppliersModel;
use App\Models\DiscountModel;
use App\Models\SuppliersModel;
use App\Controllers\BaseController;
use App\Models\CustomersModel;
use App\Models\MontirsModel;
use App\Models\CardStocksModel;
use App\Models\SupplierItemsModel;
use Dompdf\Dompdf;

class TransactionSupplier extends BaseController
{
    public function __construct()
    {

        $this->db = db_connect();
        // $this->load = Load
        $this->checkSupplierModel = new CheckSuppliersModel();
        $this->customerModel = new CustomersModel();
        $this->montirsModel = new MontirsModel();
        $this->itemModel = new ItemsModel();
        $this->supplierModel = new SuppliersModel();
        $this->supplierItemModel = new SupplierItemsModel();
        $this->discountModel = new DiscountModel();
        $this->otherCostModel = new OtherCostModel();
        $this->serviceModel = new ServiceModel();
    }

    public function checkSupplier()
    {
        // $transactions = $this->checkSupplierModel->findAll();
        $items = $this->itemModel->findAll();

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        // Transaction
        $builder_transaction = $this->db->table("check_suppliers");
        $builder_transaction->select('check_suppliers.code_order, check_suppliers.date_trasanction, customers.plat_nomor, check_suppliers.total_pay');
        $builder_transaction->join('customers', 'check_suppliers.customer = customers.id');
        $transactions = $builder_transaction->get()->getResult();

        $data = [
            'title' => 'Transaksi Barang',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'checkSuppliers',
            'transactions' => $transactions,
            'items' => $items
        ];
        return view('pages/transaction', $data);
    }

    public function storeCheckSupplier()
    {
        $transactions = $this->checkSupplierModel->findAll();
        $items = $this->itemModel->findAll();
        $customers = $this->customerModel->findAll();
        $montirs = $this->montirsModel->findAll();
        $discounts = $this->discountModel->findAll();
        $othercosts = $this->otherCostModel->findAll();
        $services = $this->serviceModel->findAll();
        
        //Generate Code Items
        $count = count($transactions);
        if($count == 0) {
            $var = 1;
        } else {
            $var = $count + 1;
        }
        $generate_code = sprintf('%05d', $var);

        $builder = $this->db->table("supplier_items");
        $builder->select('supplier_items.*, items.name as nama_item, items.code as code_item, items.stock as stock_item, items.price as price');
        $builder->join('items', 'supplier_items.id_item = items.id_item');
        $builder->where('supplier_items.code_order', 'TR'.$generate_code);
        $itemPrice = $builder->get()->getResult();

        $builder = $this->db->table("supplier_items");
        $builder->select('sum(subtotal) as total_pay');
        $builder->where('code_order', 'TR'.$generate_code);
        $total_pay = $builder->get()->getResult();

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();        

        $data = [
            'title' => 'Tambah Transaksi',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'checkSuppliers',
            'new_code' => 'TR'.$generate_code,
            'items' => $items,
            'item_supplier' => $itemPrice,
            'total_pay' => $total_pay,
            'customers' => $customers,
            'montirs' => $montirs,
            'discounts' => $discounts,
            'othercosts' => $othercosts,
            'services' => $services
        ];

        return view('pages/transaction_supplier/create', $data);
    }

    public function storeSupplier()
    {
        if (!$this->validate([
            'customer' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harus dipilih Pelanggan.',
                ],
            ],
            'montir' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harus dipilih Montir.',
                ],
            ],
            'discount' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harus dipilih Discount.',
                ],
            ],
            'service' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harus dipilih Service.',
                ],
            ],
            'service1' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harus dipilih Service.',
                ],
            ],
            'service2' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harus dipilih Service.',
                ],
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('check_suppliers/store'));
        }

        $builder = $this->db->table("supplier_items");
        $builder->select('sum(subtotal) as total_pay');
        $builder->where('code_order', $this->request->getPost('code'));
        $total_pays = $builder->get()->getResult();

        // Discount equal
        $discounts = $this->request->getPost('discount');

        $services = $this->request->getPost('service');
        $builder = $this->db->table("services");
        $builder->select('*');
        $builder->where('id', $services);
        $services1 = $builder->get()->getResult();
        $servicesDetail = $services1;

        $services11 = $this->request->getPost('service1');
        $builder = $this->db->table("services");
        $builder->select('*');
        $builder->where('id', $services11);
        $services2 = $builder->get()->getResult();
        $servicesDetail2 = $services2;

        $services12 = $this->request->getPost('service2');
        $builder = $this->db->table("services");
        $builder->select('*');
        $builder->where('id', $services12);
        $services3 = $builder->get()->getResult();
        $servicesDetail3 = $services3;

        if($services == '0') {
            if($discounts == 0) {
                $total_pay = $total_pays[0]->total_pay + 0;
            } else {
                $discount_amount = $discounts/100;
                $item_amount = $total_pays[0]->total_pay;
                $total_pay = ($item_amount - ($item_amount * $discount_amount)) + 0;
            }
        } else {
            if($discounts == 0) {
                if($services1 == null) {
                    $services1 = 0;
                } else {
                    $services1 = $services1[0]->price;
                }
                if($services2 == null) {
                    $services2 = 0;
                } else {
                    $services2 = $services2[0]->price;
                }
                if($services3 == null) {
                    $services3 = 0;
                } else {
                    $services3 = $services3[0]->price;
                }
                $total_pay = $total_pays[0]->total_pay + $services1 + $services2 + $services3;
            } else {
                if($services1 == null) {
                    $services1 = 0;
                } else {
                    $services1 = $services1[0]->price;
                }
                if($services2 == null) {
                    $services2 = 0;
                } else {
                    $services2 = $services2[0]->price;
                }
                if($services3 == null) {
                    $services3 = 0;
                } else {
                    $services3 = $services3[0]->price;
                }
                $discount_amount = $discounts/100;
                $item_amount = $total_pays[0]->total_pay;
                $total_pay = ($item_amount - ($item_amount * $discount_amount)) + $services1 + $services2 + $services3;
            }
        }


        if($servicesDetail == null) {
            $servicesDetailName = null;
            $servicesDetailPrice = null;
        } else {
            $servicesDetailName = $servicesDetail[0]->name;
            $servicesDetailPrice = $servicesDetail[0]->price;
        }

        if($servicesDetail2 == null) {
            $servicesDetailName2 = null;
            $servicesDetailPrice2 = null;
        } else {
            $servicesDetailName2 = $servicesDetail2[0]->name;
            $servicesDetailPrice2 = $servicesDetail2[0]->price;
        }

        if($servicesDetail3 == null) {
            $servicesDetailName3 = null;
            $servicesDetailPrice3 = null;
        } else {
            $servicesDetailName3 = $servicesDetail3[0]->name;
            $servicesDetailPrice3 = $servicesDetail3[0]->price;
        }

        // if($total_pays[0]->total_pay == null) {
        //     session()->setFlashdata('error', 'Harus memilih barang terlebih dahulu');
        //     return redirect()->to(base_url('check_suppliers/store'));
        // } else {
            $item = new CheckSuppliersModel();
            $item->insert([
                'code_order' => $this->request->getPost('code'),
                'customer' => $this->request->getPost('customer'),
                'montir' => $this->request->getPost('montir'),
                'discount' => $this->request->getPost('discount'),
                'service' => $services,
                'service_name' => $servicesDetailName,
                'service_price' => $servicesDetailPrice,
                'service1' => $services11,
                'service_name1' => $servicesDetailName2,
                'service_price1' => $servicesDetailPrice2,
                'service2' => $services12,
                'service_name2' => $servicesDetailName3,
                'service_price2' => $servicesDetailPrice3,
                'crash' => $this->request->getPost('crash'),
                'crashrepair1' => $this->request->getPost('crashrepair1'),
                'crashrepair2' => $this->request->getPost('crashrepair2'),
                'crashrepair3' => $this->request->getPost('crashrepair3'),
                'date_trasanction' => date("Y-m-d"),
                'total_pay' => $total_pay,
                'created_at' => date("Y-m-d H:i:s"),
                'created_by' => session()->get('username'),
                'updated_at' => date("Y-m-d H:i:s"),
                'updated_by' => session()->get('username')
            ]);
        // }

        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('check_suppliers'));
    }

    public function storeSupplierItem()
    {
        if (!$this->validate([
            'id_item' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harus dipilih Nama Barang.',
                ],
            ],
            'total_stock' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Stok Barang Harus diisi.',
                ],
            ],
            'discount' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Hapus dipilih Discount.',
                ],
            ],
            'plug' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Hapus dipilih Biaya Pasang.',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('check_suppliers/store'));
        }
        
        //Check In Item in Same
        $checkInItemSame1 = $this->db->table("supplier_items");
        $checkInItemSame1->select('*');
        $checkInItemSame1->where('code_order', $this->request->getPost('codeTR'));
        $checkInItemSame1->where('id_item', $this->request->getPost('id_item'));
        $checkInItemSame = $checkInItemSame1->get()->getResult();

        if($checkInItemSame == null) {
            // Check Price Item
            $builder = $this->db->table("items");
            $builder->select('*');
            $builder->where('id_item', $this->request->getPost('id_item'));
            $itemPrice = $builder->get()->getResult();

            // Check Type Item
            if($itemPrice[0]->id_type == 0) {
                $itemType = null;
            } else {
                $itemType = $this->db->table("type_items");
                $itemType->select('*');
                $itemType->where('id_type', $itemPrice[0]->id_type);
                $itemType = $itemType->get()->getResult();
                foreach($itemType as $key => $item) {
                    $itemType = $item->name;
                }
            }

            // Check Merk Item
            if($itemPrice[0]->id_merk == 0) {
                $itemMerk = null;
            } else {
                $itemMerk = $this->db->table("merk_items");
                $itemMerk->select('*');
                $itemMerk->where('id_merk', $itemPrice[0]->id_merk);
                $itemMerk = $itemMerk->get()->getResult();
                foreach($itemMerk as $key => $item) {
                    $itemMerk = $item->name;
                }
            }

            // Discount Price
            $discounts = $this->request->getPost('discount');
            $plug = $this->request->getPost('plug');
            if($discounts != 0) {
                // Sum Request stock equal Price with discount
                $discount_amount = $discounts/100;
                $item_amount = $this->request->getPost('total_stock') * $itemPrice[0]->price;
                $subtotal = $item_amount - ($item_amount * $discount_amount);
            } else {
                // Sum Reuquest stock equal Price with plug in
                $subtotal = (($this->request->getPost('total_stock') * $itemPrice[0]->price) + $plug);
            }

            $item = new SupplierItemsModel();
            $item->insert([ 
                'code_order' => $this->request->getPost('codeTR'),
                'id_item' => $this->request->getPost('id_item'),
                'discount' => $this->request->getPost('discount'),
                'plug' => $this->request->getPost('plug'),
                'stock' => $this->request->getPost('total_stock'),
                'subtotal' => $subtotal,
                'created_at' => date("Y-m-d H:i:s"),
                'created_by' => session()->get('username'),
                'updated_at' => date("Y-m-d H:i:s"),
                'updated_by' => session()->get('username'),
                'code_item' => $itemPrice[0]->code,
                'name_item' => $itemPrice[0]->name,
                'price_item' => $itemPrice[0]->price,
                'size_item' => $itemPrice[0]->size,
                'merk_item' => $itemMerk,
                'type_item' => $itemType,
            ]);

            // Create Card Stock Saldo Out
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
                'information' => $this->request->getPost('codeTR')." Barang Keluar",
                'id_item' => $checkInItemSame,
                'stock_in' => "",
                'stock_out' => $this->request->getPost('total_stock'),
                'saldo' => $checkInItemStockSame - $this->request->getPost('total_stock'),
            ]);

            // balace stock //
            $item1 = $this->db->table("items");
            $item1->select('stock');
            $item1->where('id_item', $this->request->getPost('id_item'));
            $itemPrice1 = $item1->get()->getResult();

            $items2 = $itemPrice1[0]->stock;

            $save_items = new ItemsModel();
            $save_items->update($this->request->getPost('id_item'), [
                'stock' =>  $items2 - $this->request->getPost('total_stock'),
                'updated_at'  => date("Y-m-d H:i:s"),
                'updated_by'  => session()->get('username')
            ]);

            session()->setFlashdata('success', 'Berhasil ditambah');
        } else {
            session()->setFlashData('error', 'Barang yang ditambah sudah ada di transaksi ini, silakan ubah dengan cara mengeklik icon pencil');
        }

        return redirect()->to(base_url('check_suppliers/store'));
    }

    public function updateSupplierItem($id)
    {
        //Check Item Check In
        $builder = $this->db->table("supplier_items");
        $builder->select('*');
        $builder->where('id', $id);
        $idItems = $builder->get()->getResult();

        $builder = $this->db->table("items");
        $builder->select('stock, price');
        $builder->where('id_item', $idItems[0]->id_item);
        $itemPrice = $builder->get()->getResult();
        $stockItems = $itemPrice[0]->stock;

        $stockNewItem = $this->db->table("supplier_items");
        $stockNewItem->select('stock');
        $stockNewItem->where('id', $id);
        $itemStock = $stockNewItem->get()->getResult();
        $stockNewItems = $itemStock[0]->stock;

        // Discount equal
        $total_pays = $itemPrice[0]->price * $this->request->getPost('total_stock');

        // Discount Price
        $discounts = $this->request->getPost('discount');
        $plug = $this->request->getPost('plug');
        if($discounts != 0) {
            // Sum Request stock equal Price with discount
            $discount_amount = $discounts/100;
            $item_amount = $total_pays;
            $subtotal = $item_amount - ($item_amount * $discount_amount);
        } else {
            // Sum Reuquest stock equal Price with plug in
            $subtotal = (($total_pays) + $plug);
        }

        $items = new SupplierItemsModel();
        $items->update($id, [
            'stock' => $this->request->getPost('total_stock'),
            'discount' => $this->request->getPost('discount'),
            'plug' => $this->request->getPost('plug'),
            'subtotal' =>  $subtotal,
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
            'saldo' => ($stockItems + $stockNewItems) - $this->request->getPost('total_stock'),
        ]);

        // balance stock
        $save_items = new ItemsModel();
        $save_items->update($idItems[0]->id_item, [
            'stock' =>  ($stockItems + $stockNewItems) - $this->request->getPost('total_stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('check_suppliers/store'));
    }

    public function updateDetailSupplierItem($id)
    {
        //Check Item Check In
        $builder = $this->db->table("supplier_items");
        $builder->select('supplier_items.*, check_suppliers.id as id_check_ins');
        $builder->join('check_suppliers', 'supplier_items.code_order = check_suppliers.code_order');
        $builder->where('supplier_items.id', $id);
        $idItems = $builder->get()->getResult();

        $builder = $this->db->table("items");
        $builder->select('stock, price');
        $builder->where('id_item', $idItems[0]->id_item);
        $itemPrice = $builder->get()->getResult();
        $stockItems = $itemPrice[0]->stock;

        $stockNewItem = $this->db->table("supplier_items");
        $stockNewItem->select('stock, subtotal');
        $stockNewItem->where('id', $id);
        $itemStock = $stockNewItem->get()->getResult();
        $stockNewItems = $itemStock[0]->stock;

        $priceNewItem = $this->db->table("check_suppliers");
        $priceNewItem->select('total_pay');
        $priceNewItem->where('code_order', $idItems[0]->code_order);
        $priceStock = $priceNewItem->get()->getResult();
        $priceNewItems = $priceStock[0]->total_pay;

        $items = new SupplierItemsModel();
        $items->update($id, [
            'stock' => $this->request->getPost('total_stock'),
            'subtotal' =>  $itemPrice[0]->price * $this->request->getPost('total_stock'),
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
            'saldo' => ($stockItems + $stockNewItems) - $this->request->getPost('total_stock'),
        ]);

        // balance price
        $price_items = new CheckSuppliersModel();
        $price_items->update($idItems[0]->id_check_ins, [
            'total_pay' =>  ($priceNewItems - $itemStock[0]->subtotal) + ($itemPrice[0]->price * $this->request->getPost('total_stock')),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);

        // balance stock
        $save_items = new ItemsModel();
        $save_items->update($idItems[0]->id_item, [
            'stock' =>  ($stockItems + $stockNewItems) - $this->request->getPost('total_stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->back();
    }

    public function deleteCheckItemSupplier($id)
    {
        $stockNewItem = $this->db->table("supplier_items");
        $stockNewItem->select('code_order, id_item, stock');
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
        $checkInItemSame1->like('information', $itemStock[0]->code_order);
        $checkInItemSame = $checkInItemSame1->get()->getResult();
        $array = [];
        foreach($checkInItemSame as $key => $item) {
            $array[$key] = $checkInItemSame[$key]->id;
            $cardStocks = new CardStocksModel();
            $cardStocks->delete($array[$key]);
        }

        $save_items = new ItemsModel();
        $save_items->update($itemStock[0]->id_item, [
            'stock' =>  $stockItems + $stockNewItems,
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);

        $items = new SupplierItemsModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('check_suppliers/store'));
    }

    public function deleteCheckSupplier($id)
    {
        $builder = $this->db->table("check_suppliers");
        $builder->select('check_suppliers.*');
        $builder->where('code_order', $id);
        $items = $builder->get()->getResult();

        // Check Item Supplier //
        $builder = $this->db->table("supplier_items");
        $builder->select('supplier_items.*');
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
                'stock' =>  $itemSuppliers[0]->stock + $item->stock,
                'updated_at'  => date("Y-m-d H:i:s"),
                'updated_by'  => session()->get('username')
            ]);
        }

        $this->supplierItemModel->where('code_order', $items[0]->code_order);
        $this->supplierItemModel->delete();

        $this->checkSupplierModel->where('code_order', $items[0]->code_order);
        $this->checkSupplierModel->delete();

        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('check_suppliers'));
    }

    public function detailCheckSupplier($id)
    {
        $builder = $this->db->table("check_suppliers");
        $builder->select('check_suppliers.*');
        $builder->where('code_order', $id);
        $transactions = $builder->get()->getResult();
        $discounts = $this->discountModel->findAll();
        $othercosts = $this->otherCostModel->findAll();
        $services = $this->serviceModel->findAll();
        
        // Customer //
        $customer = $this->db->table("customers");
        $customer->where('customers.id', $transactions[0]->customer);
        $customers = $customer->get()->getResult();

        // Montir //
        $montir = $this->db->table("montirs");
        $montir->where('montirs.id', $transactions[0]->montir);
        $montirs = $montir->get()->getResult();

        $items = $this->itemModel->findAll();

        $builder = $this->db->table("supplier_items");
        $builder->select('supplier_items.*, items.name as nama_item, items.code as code_item, items.stock as stock_item, items.price as price');
        $builder->join('items', 'supplier_items.id_item = items.id_item');
        $builder->where('supplier_items.code_order', $transactions[0]->code_order);
        $itemPrice = $builder->get()->getResult();

        $ownService = $this->db->table("services");
        $ownService->where('id', $transactions[0]->service);
        $ownService1 = $ownService->get()->getResult();

        $ownService3 = $this->db->table("services");
        $ownService3->where('id', $transactions[0]->service1);
        $ownService2 = $ownService3->get()->getResult();

        $ownService5 = $this->db->table("services");
        $ownService5->where('id', $transactions[0]->service2);
        $ownService4 = $ownService5->get()->getResult();

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();
        
        $data = [
            'title' => 'Detail Transaksi Keluar',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'checkSuppliers',
            'item_supplier' => $itemPrice,
            'transactions' => $transactions,
            'items' => $items,
            'customers' => $customers,
            'montirs' => $montirs,
            'othercosts' => $othercosts,
            'discounts' => $discounts,
            'services' => $services,
            'own_service' => $ownService1,
            'own_service1' => $ownService2,
            'own_service2' => $ownService4,
        ];
        return view('pages/transaction_supplier/detail', $data);
    }

    public function cetakTransaction($id)
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $builder = $this->db->table("supplier_items");
        $builder->select('supplier_items.*, items.name as nama_item, items.code as code_item, items.stock as stock_item, items.price as price');
        $builder->join('items', 'supplier_items.id_item = items.id_item');
        $builder->where('supplier_items.code_order', $id);
        $items = $builder->get()->getResult();

        $builder = $this->db->table("check_suppliers");
        $builder->select('check_suppliers.*, customers.name as nama_customers, customers.code as code_customers, customers.type_motor, customers.plat_nomor, montirs.name as name_montirs, montirs.nip as code_montirs');
        $builder->join('customers', 'check_suppliers.customer = customers.id');
        $builder->join('montirs', 'check_suppliers.montir = montirs.id');
        $builder->where('check_suppliers.code_order', $id);
        $transactions = $builder->get()->getResult();

        $builder = $this->db->table("services");
        $builder->where('id', $transactions[0]->service);
        $services = $builder->get()->getResult();

        $builder1 = $this->db->table("services");
        $builder1->where('id', $transactions[0]->service1);
        $services1 = $builder1->get()->getResult();

        $builder2 = $this->db->table("services");
        $builder2->where('id', $transactions[0]->service2);
        $services2 = $builder2->get()->getResult();

        $filename = 'invoice-'.$id.'-'.$transactions[0]->date_trasanction;

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.*');
        $sites = $builder_name_site->get()->getResult();

        // load HTML content
        $dompdf->loadHtml(view('/pages/transaction_supplier/cetak', ['items' => $items, 'code' => $id, 'transactions' => $transactions, 'sites' => $sites, 'services' => $services, 'services1' => $services1, 'services2' => $services2]));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}