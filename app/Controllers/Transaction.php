<?php

namespace App\Controllers;

use App\Models\CheckInsModel;
use App\Models\CheckOutsModel;
use App\Models\CheckSuppliersModel;
use App\Controllers\BaseController;
use App\Database\Migrations\MerkItems;
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
        $this->checkSupplierModel = new CheckSuppliersModel();

        $this->itemModel = new ItemsModel();
        $this->supplierModel = new SuppliersModel();
    }

    public function index()
    {
        //
    }

    public function checkIn()
    {
        $builder = $this->db->table("check_ins ");
        $builder->select('check_ins.*, items.name as item, items.code as code_item, items.id_item as id_item, suppliers.name as supplier, suppliers.code as code_supplier, suppliers.id_supplier as id_supplier');
        $builder->join('items', 'check_ins.id_item = items.id_item');
        $builder->join('suppliers', 'check_ins.id_supplier = suppliers.id_supplier');
        $transactions = $builder->get()->getResult();
        
        $items = $this->itemModel->findAll();
        $suppliers = $this->supplierModel->findAll();

        $data = [
            'title' => 'Transaksi Barang Masuk',
            'type' => 'checkIns',
            'transactions' => $transactions,
            'items' => $items,
            'suppliers' => $suppliers
        ];

        return view('pages/transaction', $data);
    }

    public function createCheckIn()
    {
        if (!$this->validate([
            'id_item' => [

            ],
            'id_supplier' => [

            ],
            'stock' => [

            ],
            'price' => [

            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('items'));
        }

        $convertToArray = explode(' ', $this->request->getPost('price'));
        $slicedToArray = explode('.', $convertToArray[1]);
        $joinToArray = join("",$slicedToArray);

        $items = new CheckInsModel();
        $items->insert([
            'id_item' => $this->request->getPost('id_item'),
            'id_supplier' => $this->request->getPost('id_supplier'),
            'stock' => $this->request->getPost('stock'),
            'price' => $joinToArray,
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
            'stock' => $items2 + $this->request->getPost('stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('check_in'));
    }

    public function updateCheckIn($id)
    {
        $convertToArray = explode(' ', $this->request->getPost('price'));
        $slicedToArray = explode('.', $convertToArray[1]);
        $joinToArray = join("",$slicedToArray);

        $builder = $this->db->table("items");
        $builder->select('stock');
        $builder->where('id_item', $this->request->getPost('id_item'));
        $itemPrice = $builder->get()->getResult();
        $stockItems = $itemPrice[0]->stock;

        $stockNewItem = $this->db->table("check_ins");
        $stockNewItem->select('stock');
        $stockNewItem->where('id', $id);
        $itemStock = $stockNewItem->get()->getResult();
        $stockNewItems = $itemStock[0]->stock;

        
        $items = new CheckInsModel();
        $items->update($id, [
            'id_item' => $this->request->getPost('id_item'),
            'id_supplier' => $this->request->getPost('id_supplier'),
            'stock' => $this->request->getPost('stock'),
            'price' => $joinToArray,
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);

        // balance stock
        $save_items = new ItemsModel();
        $save_items->update($this->request->getPost('id_item'), [
            'stock' =>  ($stockItems - $stockNewItems) + $this->request->getPost('stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('check_in'));
    }

    public function deleteCheckIn($id)
    {
        $stockNewItem = $this->db->table("check_ins");
        $stockNewItem->select('stock, id_item');
        $stockNewItem->where('id', $id);
        $itemStock = $stockNewItem->get()->getResult();
        $stockNewItems = $itemStock[0]->stock;

        $builder = $this->db->table("items");
        $builder->select('stock');
        $builder->where('id_item', $itemStock[0]->id_item);
        $itemPrice = $builder->get()->getResult();
        $stockItems = $itemPrice[0]->stock;

        // balance stock
        $save_items = new ItemsModel();
        $save_items->update($itemStock[0]->id_item, [
            'stock' =>  ($stockItems - $stockNewItems),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);

        $items = new CheckInsModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('check_in'));
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
