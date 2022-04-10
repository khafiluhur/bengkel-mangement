<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\ItemsModel;
use App\Models\TypeItemsModel;
use App\Models\MerkItemsModel;
use App\Models\SuppliersModel;
use App\Controllers\BaseController;
use App\Models\CustomersModel;
use App\Models\MontirsModel;

class Master extends BaseController
{
    public function __construct()
    {
        $this->itemModel = new ItemsModel();
        $this->typeItemModel = new TypeItemsModel();
        $this->merkItemModel = new MerkItemsModel();
        $this->supplierModel = new SuppliersModel();
        $this->montirModel = new MontirsModel();
        $this->customerModel = new CustomersModel();
    }

    public function item()
    {
        $items = $this->itemModel->findAll();
        $type = $this->typeItemModel->findAll();
        $merk = $this->merkItemModel->findAll();
        $supplier = $this->supplierModel->findAll();

        //Generate Code Items
        $count = count($items);
        if($count == 0) {
            $var = 1;
        } else {
            $var = $count + 1;
        }
        $generate_code = sprintf('%04d', $var);

        $data = [
            'title' => 'Data Barang',
            'type' => 'dataItems',
            'items' => $items,
            'new_code' => 'BRG'.$generate_code,
            'typeitem' => $type,
            'merkitem' => $merk,
            'supplier' => $supplier
        ];
        return view('pages/master', $data);
    }

    public function createItem()
    {
        if (!$this->validate([
            'name' => [
            ],
            'price' => [

            ],
            'id_type' => [

            ],
            'id_merk' => [

            ],
            'id_supplier' => [

            ],
            'stock' => [

            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('items'));
        }

        $convertToArray = explode(' ', $this->request->getPost('price'));
        $slicedToArray = explode('.', $convertToArray[1]);
        $joinToArray = join("",$slicedToArray);

        $items = new ItemsModel();
        $items->insert([
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'price' => $joinToArray,
            'image' => $this->request->getPost('image'),
            'size' => $this->request->getPost('size'),
            'id_type' => $this->request->getPost('id_type'),
            'id_supplier' => $this->request->getPost('id_supplier'),
            'id_merk' => $this->request->getPost('id_merk'),
            'stock' => $this->request->getPost('stock'),
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => session()->get('username'),
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('items'));
    }

    public function updateItem($id)
    {
        $convertToArray = explode(' ', $this->request->getPost('price'));
        $slicedToArray = explode('.', $convertToArray[1]);
        $joinToArray = join("",$slicedToArray);

        $items = new ItemsModel();
        $items->update($id, [
            'name' => $this->request->getPost('name'),
            'price' => $joinToArray,
            'image' => $this->request->getPost('image'),
            'size' => $this->request->getPost('size'),
            'id_type' => $this->request->getPost('id_type'),
            'id_supplier' => $this->request->getPost('id_supplier'),
            'id_merk' => $this->request->getPost('id_merk'),
            'stock' => $this->request->getPost('stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('items'));
    }

    public function deleteItem($id)
    {
        $items = new ItemsModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('items'));
    }

    public function typeItem()
    {
        $items = $this->typeItemModel->findAll();
        $data = [
            'title' => 'Jenis Barang',
            'type' => 'typeItems',
            'items' => $items
        ];
        return view('pages/master', $data);
    }

    public function createTypeItem()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[type_items.name]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'is_unique' => 'Jenis Barang sudah ada di database'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('type_items'));
        }
        $items = new TypeItemsModel();
        $items->insert([
            'name' => $this->request->getPost('name'),
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => session()->get('username'),
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('type_items'));
    }

    public function updateTypeItem($id)
    {
        $items = new TypeItemsModel();
        $items->update($id, [
            'name'        => $this->request->getPost('name'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username'),
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('type_items'));
    }

    public function deleteTypeItem($id)
    {
        $items = new TypeItemsModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('type_items'));
    }

    public function merkItem()
    {
        $items = $this->merkItemModel->findAll();
        $data = [
            'title' => 'Merek Barang',
            'type' => 'merkItems',
            'items' => $items
        ];
        return view('pages/master', $data);
    }

    public function createMerkItem()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[merk_items.name]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'is_unique' => 'Merk Barang sudah ada di database'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('merk_items'));
        }
        $items = new MerkItemsModel();
        $items->insert([
            'name' => $this->request->getPost('name'),
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => session()->get('username'),
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('merk_items'));
    }

    public function updateMerkItem($id)
    {
        $items = new MerkItemsModel();
        $items->update($id, [
            'name'        => $this->request->getPost('name'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username'),
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('merk_items'));
    }

    public function deleteMerkItem($id)
    {
        $items = new MerkItemsModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('merk_items'));
    }

    public function supplier()
    {
        $items = $this->supplierModel->findAll();
        $data = [
            'title' => 'Supplier',
            'type' => 'suppliers',
            'items' => $items
        ];
        return view('pages/master', $data);
    }

    public function createSupplier()
    {
        if (!$this->validate([
            'code' => [
                'rules' => 'required|is_unique[suppliers.code]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'is_unique' => 'Kode Supplier sudah ada di database'
                ]
            ],
            'name' => [
                'rules' => 'required|is_unique[suppliers.name]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'is_unique' => 'Nama Supplier sudah ada di database'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('suppliers'));
        }
        $items = new SuppliersModel();
        $items->insert([
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'name_pic' => $this->request->getPost('name_pic'),
            'telepone_pic' => $this->request->getPost('telepone_pic'),
            'alamat' => $this->request->getPost('alamat'),
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => session()->get('username'),
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session()->get('username')
        ]);
        $users = new UsersModel();
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('suppliers'));
    }

    public function updateSupplier($id)
    {
        $items = new SuppliersModel();
        $items->update($id, [
            'name'        => $this->request->getPost('name'),
            'name_pic' => $this->request->getPost('name_pic'),
            'telepone_pic' => $this->request->getPost('telepone_pic'),
            'alamat' => $this->request->getPost('alamat'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username'),
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('suppliers'));
    }

    public function deleteSupplier($id)
    {
        $items = new SuppliersModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('suppliers'));
    }

    public function montir()
    {
        $items = $this->montirModel->findAll();
        $data = [
            'title' => 'Data Montir',
            'type' => 'montirs',
            'items' => $items
        ];
        return view('pages/master', $data);
    }

    public function createMontir()
    {
        if (!$this->validate([
            'nip' => [
            ],
            'name' => [
            ],
            'telepone' => [
            ],
            'alamat' => [
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('montirs'));
        }
        $items = new MontirsModel();
        $items->insert([
            'nip' => $this->request->getPost('nip'),
            'name' => $this->request->getPost('name'),
            'telepone' => $this->request->getPost('telepone'),
            'alamat' => $this->request->getPost('alamat'),
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => session()->get('username'),
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('montirs'));
    }

    public function updateMontir($id)
    {
        $items = new MontirsModel();
        $items->update($id, [
            'nip' => $this->request->getPost('nip'),
            'name' => $this->request->getPost('name'),
            'telepone' => $this->request->getPost('telepone'),
            'alamat' => $this->request->getPost('alamat'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username'),
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('montirs'));
    }

    public function deleteMontir($id)
    {
        $items = new MontirsModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('montirs'));
    }

    public function customer()
    {
        $items = $this->customerModel->findAll();
        $data = [
            'title' => 'Data Customer',
            'type' => 'customer',
            'items' => $items
        ];
        return view('pages/master', $data);
    }

    public function createCustomer()
    {
        // dd($this->request);
        if (!$this->validate([
            'name' => [
            ],
            'plat_nomor' => [
            ],
            'type_motor' => [
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('customers'));
        }

        $items = new CustomersModel();
        $items->insert([
            'name' => $this->request->getPost('name'),
            'plat_nomor' => $this->request->getPost('plat_nomor'),
            'type_motor' => $this->request->getPost('type_motor'),
        ]);
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('customers'));
    }

    public function updateCustomer($id)
    {
        $items = new CustomersModel();
        $items->update($id, [
            'name' => $this->request->getPost('name'),
            'plat_nomor' => $this->request->getPost('plat_nomor'),
            'type_motor' => $this->request->getPost('type_motor'),
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('customers'));
    }

    public function deleteCustomer($id)
    {
        $items = new CustomersModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('customers'));
    }
}
