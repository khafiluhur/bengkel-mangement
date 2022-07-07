<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\ItemsModel;
use App\Models\ServiceModel;
use App\Models\TypeItemsModel;
use App\Models\MerkItemsModel;
use App\Models\SuppliersModel;
use App\Controllers\BaseController;
use App\Models\CustomersModel;
use App\Models\MontirsModel;
use App\Models\CardStocksModel;
use Config\Database;

class Master extends BaseController
{
    public function __construct()
    {
        $this->db = Database::connect();
        $this->itemModel = new ItemsModel();
        $this->servicesModel = new ServiceModel();
        $this->typeItemModel = new TypeItemsModel();
        $this->merkItemModel = new MerkItemsModel();
        $this->supplierModel = new SuppliersModel();
        $this->montirModel = new MontirsModel();
        $this->customerModel = new CustomersModel();
        $this->cardStockModel = new CardStocksModel();
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
        $code_items = "BRG".$generate_code;
        // Check Code Items
        $checkCodeItem = $this->db->table("items");
        $checkCodeItem->select('code');
        $checkCodeItem->where('code', $code_items);
        $checkCodeItem = $checkCodeItem->get()->getResult();
        if($checkCodeItem = true) {
            $var = $count + 2;
            $generate_item_code = "BRG".sprintf('%04d', $var);
        } else {
            $var = $count + 1;
            $generate_item_code = "BRG".sprintf('%04d', $var);
        }
        
        $total = [];
        foreach($items as $key => $value) {
            $total = $value['price'] * $value['stock'];
        }

        $array = [];
        foreach($items as $key => $item) {
            $array[$key]['id_item'] = $items[$key]['id_item'];
            $array[$key]['code'] = $items[$key]['code'];
            $array[$key]['name'] = $items[$key]['name'];
            $array[$key]['price'] = $items[$key]['price'];
            $array[$key]['image'] = $items[$key]['image'];
            $array[$key]['size'] = $items[$key]['size'];
            $array[$key]['id_type'] = $items[$key]['id_type'];
            $array[$key]['id_merk'] = $items[$key]['id_merk'];

            //Check Type Item
            $array[$key]['name_type'] = null;
            if($items[$key]['id_type'] == 0) {
                $array[$key]['name_type'] = null;
            } else {
                $checkTypeItem = $this->db->table("type_items");
                $checkTypeItem->select('*');
                $checkTypeItem->where('id_type', $items[$key]['id_type']);
                $checkTypeItem = $checkTypeItem->get()->getResult();
                $array[$key]['name_type'] = $checkTypeItem[0]->name;
            }
            
            //Check Merk Item
            $array[$key]['name_merk'] = null;
            if($items[$key]['id_merk'] == 0) {
                $array[$key]['name_merk'] = null;
            } else {
                $checkMerkItem = $this->db->table("merk_items");
                $checkMerkItem->select('*');
                $checkMerkItem->where('id_merk', $items[$key]['id_merk']);
                $checkMerkItem = $checkMerkItem->get()->getResult();
                $array[$key]['name_merk'] = $checkMerkItem[0]->name;
            }

            $array[$key]['stock'] = $items[$key]['stock'];
            $array[$key]['limit_stock'] = $items[$key]['limit_stock'];

            //Check Supplier Item in Same
            $checkSupplierItemSame = $this->db->table("supplier_items");
            $checkSupplierItemSame->select('COUNT(*) as total_supplier_item');
            $checkSupplierItemSame->where('id_item', $array[$key]['id_item']);
            $checkInItemSame = $checkSupplierItemSame->get()->getResult();
            $array[$key]['count_suppiler_item'] = $checkInItemSame[0]->total_supplier_item;

            //Check In Item in Same
            $checkInItemSame = $this->db->table("check_in_items");
            $checkInItemSame->select('COUNT(*) as total_check_in_item');
            $checkInItemSame->where('id_item', $array[$key]['id_item']);
            $checkInItemSame = $checkInItemSame->get()->getResult();
            $array[$key]['count_check_in_item'] = $checkInItemSame[0]->total_check_in_item;
        }

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = [
            'title' => 'Data Barang',
            'name_site' => $name_sites[0]->name_site, 
            'type' => 'dataItems',
            'items' => $array,
            'total' => $total,
            'new_code' => $generate_item_code,
            'typeitem' => $type,
            'merkitem' => $merk,
            'supplier' => $supplier
        ];
        return view('pages/master/items', $data);
    }

    public function createItem()
    {
        if (!$this->validate([
            'code' => [
                'rules'  => 'required|is_unique[items.code]',
                'errors' => [
                    'is_unique' => 'Kode Barang Tidak Boleh Sama.',
                ],
            ],
            'name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Name Barang Harus diisi.',
                ],
            ],
            'price' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harga Barang Harus diisi.',
                ],
            ],
            'stock' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Stok Barang Harus diisi.',
                ],
            ],
            'limit_stock' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Minimal Stok Barang Harus diisi.',
                ],
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('items'));
        }

        $convertToArray = explode(' ', $this->request->getPost('price'));
        if(count($convertToArray) == 2) {
            $slicedToArray = explode('.', $convertToArray[1]);
            $joinToArray = join("",$slicedToArray);
        } else {
            $joinToArray = $this->request->getPost('price');
        }

        $items = new ItemsModel();
        $items->insert([
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'price' => $joinToArray,
            'image' => $this->request->getPost('image'),
            'size' => $this->request->getPost('size'),
            'id_type' => $this->request->getPost('id_type'),
            'id_merk' => $this->request->getPost('id_merk'),
            'stock' => $this->request->getPost('stock'),
            'limit_stock' => $this->request->getPost('limit_stock'),
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => session()->get('username'),
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session()->get('username')
        ]);
        $cardStocks = new CardStocksModel();
        $cardStocks->insert([
            'date' => date("Y-m-d"),
            'information' => "Saldo ".$this->request->getPost('code'),
            'id_item' => $this->request->getPost('code'),
            'stock_in' => "",
            'stock_out' => "",
            'saldo' => $this->request->getPost('stock'),
        ]);
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('items'));
    }

    public function updateItem($id)
    {
        $convertToArray = explode(' ', $this->request->getPost('price'));
        if(count($convertToArray) == 2) {
            $slicedToArray = explode('.', $convertToArray[1]);
            $joinToArray = join("",$slicedToArray);
        } else {
            $joinToArray = $this->request->getPost('price');
        }

        $items = new ItemsModel();
        $items->update($id, [
            'name' => $this->request->getPost('name'),
            'price' => $joinToArray,
            // 'image' => $this->request->getPost('image'),
            'size' => $this->request->getPost('size'),
            'id_type' => $this->request->getPost('id_type'),
            'id_merk' => $this->request->getPost('id_merk'),
            // 'stock' => $this->request->getPost('stock'),
            'limit_stock' => $this->request->getPost('limit_stock'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'updated_by'  => session()->get('username')
        ]);

        $checkInItemSame1 = $this->db->table("items");
        $checkInItemSame1->select('code');
        $checkInItemSame1->where('id_item', $id);
        $checkInItemSame = $checkInItemSame1->get()->getResult();
        foreach($checkInItemSame as $key => $item) {
            $checkInItemSame = $item->code;
        }

        $checkInItemSame1 = $this->db->table("card_stocks");
        $checkInItemSame1->select('*');
        $checkInItemSame1->where('id_item', $checkInItemSame);
        $checkInItemSame = $checkInItemSame1->get()->getResult();

        if($checkInItemSame == null) {
            $cardStocks = new CardStocksModel();
            $cardStocks->insert([
                'date' => date("Y-m-d"),
                'information' => "Saldo ".$this->request->getPost('code'),
                'id_item' => $this->request->getPost('code'),
                'stock_in' => "",
                'stock_out' => "",
                // 'saldo' => $this->request->getPost('stock'),
            ]);
        }
        
        session()->setFlashdata('success', 'Berhasil diupdate ');
        return redirect()->to(base_url('items'));
    }

    public function deleteItem($id)
    {
        $items = new ItemsModel();
        $cardStockModel = new CardStocksModel();

        $checkInItemSame1 = $this->db->table("items");
        $checkInItemSame1->select('code');
        $checkInItemSame1->where('id_item', $id);
        $checkInItemSame = $checkInItemSame1->get()->getResult();
        foreach($checkInItemSame as $key => $item) {
            $checkInItemSame = $item->code;
        }
        
        $checkInItemSame1 = $this->db->table("card_stocks");
        $checkInItemSame1->select('id');
        $checkInItemSame1->where('id_item', $checkInItemSame);
        $checkInItemSame2 = $checkInItemSame1->get()->getResult();

        if($checkInItemSame2 != null) {
            foreach($checkInItemSame2 as $key => $item) {
                $checkInItemSame2 = $item->id;
            }
            $cardStockModel->delete($checkInItemSame2);
        }

        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('items'));
    }

    public function typeItem()
    {
        $items = $this->typeItemModel->findAll();

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        // Check Type use Transaction
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('*');
        $name_sites = $builder_name_site->get()->getResult();
        
        $data = [
            'title' => 'Kategori',
            'name_site' => $name_sites[0]->name_site,
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
                    'required' => 'Kategori Harus diisi',
                    'is_unique' => 'Kategori sudah ada di database'
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

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = [
            'title' => 'Merek Barang',
            'name_site' => $name_sites[0]->name_site,
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
                    'required' => 'Nama Merek Barang Harus diisi',
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

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = [
            'title' => 'Data Supplier',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'suppliers',
            'items' => $items
        ];
        return view('pages/master', $data);
    }

    public function createSupplier()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[suppliers.name]',
                'errors' => [
                    'required' => 'Nama Supplier Barang Harus diisi',
                    'is_unique' => 'Nama Supplier sudah ada di database'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('suppliers'));
        }

        //Generate Code Items
        $suppliers = $this->supplierModel->findAll();
        $count = count($suppliers);
        if($count == 0) {
            $var = 1;
        } else {
            $var = $count + 1;
        }
        $generate_code = sprintf('%04d', $var);

        $items = new SuppliersModel();
        $items->insert([
            'code' => 'MJMS'.$generate_code,
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

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = [
            'title' => 'Data Montir',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'montirs',
            'items' => $items
        ];
        return view('pages/master', $data);
    }

    public function createMontir()
    {
        if (!$this->validate([
            'name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama Montir Harus diisi.',
                ],
            ],
            'telepone' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'No Telepone Montir Harus diisi.',
                ],
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat Montir Harus diisi.',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('montirs'));
        }

        //Generate Code Items
        $montirs = $this->montirModel->findAll();
        $count = count($montirs);
        if($count == 0) {
            $var = 1;
        } else {
            $var = $count + 1;
        }
        $generate_code = sprintf('%04d', $var);

        $items = new MontirsModel();
        $items->insert([
            'nip' => 'MJME'.$generate_code,
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

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = [
            'title' => 'Data Pelanggan',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'customer',
            'items' => $items
        ];
        return view('pages/master', $data);
    }

    public function createCustomer()
    {
        if (!$this->validate([
            'name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama Pelanggan Harus diisi.',
                ],
            ],
            'plat_nomor' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Plat Motor Harus diisi.',
                ],
            ],
            'type_motor' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jenis Motor Harus diisi.',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('customers'));
        }

        //Generate Code Items
        $customers = $this->customerModel->findAll();
        $count = count($customers);
        if($count == 0) {
            $var = 1;
        } else {
            $var = $count + 1;
        }
        $generate_code = sprintf('%04d', $var);

        $items = new CustomersModel();
        $items->insert([
            'code' => 'MJMC'.$generate_code,
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

    public function service()
    {
        $items = $this->servicesModel->findAll();

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = [
            'title' => 'Data Service',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'services',
            'items' => $items
        ];
        return view('pages/master', $data);
    }

    public function createService()
    {
        if (!$this->validate([
            'name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama Service Harus diisi.',
                ],
            ],
            'price' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harga Service Harus diisi.',
                ],
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('services'));
        }

        $convertToArray = explode(' ', $this->request->getPost('price'));
        if(count($convertToArray) == 2) {
            $slicedToArray = explode('.', $convertToArray[1]);
            $joinToArray = join("",$slicedToArray);
        } else {
            $joinToArray = $this->request->getPost('price');
        }

        $items = new ServiceModel();
        $items->insert([
            'name' => $this->request->getPost('name'),
            'price' => $joinToArray,
        ]);
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('services'));
    }

    public function updateService($id)
    {
        $convertToArray = explode(' ', $this->request->getPost('price'));
        if(count($convertToArray) == 2) {
            $slicedToArray = explode('.', $convertToArray[1]);
            $joinToArray = join("",$slicedToArray);
        } else {
            $joinToArray = $this->request->getPost('price');
        }

        $items = new ServiceModel();
        $items->update($id, [
            'name' => $this->request->getPost('name'),
            'price' => $joinToArray,
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('services'));
    }

    public function deleteService($id)
    {
        $items = new ServiceModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('services'));
    }
}
