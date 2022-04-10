<?php
namespace App\Controllers;

use App\Models\ItemsModel;
use App\Models\CheckSuppliersModel;
use App\Models\SuppliersModel;
use App\Controllers\BaseController;
use App\Database\Migrations\CheckSuppliers;
use App\Models\SupplierItemsModel;
use CodeIgniter\HTTP\Request;

class TransactionSupplier extends BaseController
{
    public function __construct()
    {

        $this->db = db_connect();
        // $this->load = Load
        $this->checkSupplierModel = new CheckSuppliersModel();

        $this->itemModel = new ItemsModel();
        $this->supplierModel = new SuppliersModel();
        $this->supplierItemModel = new SupplierItemsModel();
    }

    public function checkSupplier()
    {
        $transactions = $this->checkSupplierModel->findAll();
        $items = $this->itemModel->findAll();

        $data = [
            'title' => 'Pemesanan ke Supplier',
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
        
        //Generate Code Items
        $count = count($transactions);
        if($count == 0) {
            $var = 1;
        } else {
            $var = $count + 1;
        }
        $generate_code = sprintf('%05d', $var);

        $builder = $this->db->table("supplier_items");
        $builder->select('supplier_items.*, items.name as nama_item, items.code as code_item, items.price as price_item');
        $builder->join('items', 'supplier_items.id_item = items.id_item');
        $builder->where('supplier_items.code_order', 'TR'.$generate_code);
        $itemPrice = $builder->get()->getResult();


        $builder = $this->db->table("supplier_items");
        $builder->select('sum(subtotal) as total_pay');
        $builder->where('code_order', 'TR'.$generate_code);
        $total_pay = $builder->get()->getResult();

        $data = [
            'title' => 'Tambah Transaksi',
            'type' => 'checkSuppliers',
            'new_code' => 'TR'.$generate_code,
            'items' => $items,
            'item_supplier' => $itemPrice,
            'total_pay' => $total_pay
        ];

        return view('pages/transaction_supplier/create', $data);
    }

    public function storeSupplier()
    {
        if (!$this->validate([
            'code' => [

            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('check_suppliers'));
        }

        $builder = $this->db->table("supplier_items");
        $builder->select('sum(subtotal) as total_pay');
        $builder->where('code_order', $this->request->getPost('code'));
        $total_pay = $builder->get()->getResult();

        $item = new CheckSuppliersModel();
        $item->insert([
            'code_order' => $this->request->getPost('code'),
            'date_trasanction' => date("Y-m-d"),
            'total_pay' => $total_pay[0]->total_pay,
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => session()->get('username'),
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session()->get('username')
        ]);

        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('check_suppliers'));
    }

    public function storeSupplierItem()
    {
        if (!$this->validate([
            'id_item' => [

            ],
            'stock' => [

            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('check_suppliers/store'));
        }
        

        // Check Price Item //
        $builder = $this->db->table("items");
        $builder->select('price');
        $builder->where('id_item', $this->request->getPost('id_item'));
        $itemPrice = $builder->get()->getResult();

        // Sum Request stock equal Price
        $subtotal = $this->request->getPost('total_stock') * $itemPrice[0]->price;

        $item = new SupplierItemsModel();
        $item->insert([
            'code_order' => $this->request->getPost('codeTR'),
            'id_item' => $this->request->getPost('id_item'),
            'stock' => $this->request->getPost('total_stock'),
            'subtotal' => $subtotal,
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => session()->get('username'),
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session()->get('username')
        ]);

        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('check_suppliers/store'));
    }

    public function deleteCheckItemSupplier($id)
    {
        $items = new SupplierItemsModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('check_suppliers/store'));
    }

    public function deleteCheckSupplier($id)
    {
        $items = $this->checkSupplierModel->find($id);
        $this->supplierItemModel->where('code_order', $items['code_order']);
        $this->supplierItemModel->delete();
        $this->checkSupplierModel->delete($id);

        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('check_suppliers'));
    }

    public function detailCheckSupplier($id)
    {

        $transactions = $this->checkSupplierModel->find($id);
        $items = $this->itemModel->findAll();

        $builder = $this->db->table("supplier_items");
        $builder->select('supplier_items.*, items.name as nama_item, items.code as code_item, items.price as price_item');
        $builder->join('items', 'supplier_items.id_item = items.id_item');
        $builder->where('supplier_items.code_order', $transactions['code_order']);
        $itemPrice = $builder->get()->getResult();

        $data = [
            'title' => 'Detail Transaksi',
            'type' => 'checkSuppliers',
            'item_supplier' => $itemPrice,
            'transactions' => $transactions,
            'items' => $items
        ];
        return view('pages/transaction_supplier/detail', $data);
    }

    public function cetakTransaction()
    {
        $data = array(
            "dataku" => array(
                "nama" => "Petani Kode",
                "url" => "http://petanikode.com"
            )
        );
    
        $this->load->library('pdf');
    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan-petanikode.pdf";
        return view('/pages/transaction_supplier/cetak', $data);
    }
}