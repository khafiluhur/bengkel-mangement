<?php

namespace App\Controllers;

use App\Models\ItemsModel;
use App\Models\SettingSiteModel;
use App\Models\TypeItemsModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->itemModel = new ItemsModel();
        $this->settingSiteModel = new SettingSiteModel();
        $this->typeItemModel = new TypeItemsModel();
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function home()
    {
        $items = $this->itemModel->findAll();
        $types = $this->typeItemModel->findAll();

        // Alert Stock Limit
        // $limit_stock = [];
        // $builder = $this->db->table("items");
        // $builder->select('items.*');
        // $item_stock = $builder->get()->getResult();

        // foreach($item_stock as $key => $item) {
        //     $test[$key] = $item_stock[$key]->stock - $item_stock[$key]->limit_stock;
        //     dd($test[1]);
        //     if($test[$key] <= 0) {
        //         $limit_stock = array("stock" => $limit_stock[$key]);
        //     } else {
        //         $limit_stock = array("stock" => $limit_stock[$key]);
        //     }
        // }
        // dd($item_stock);

        // Total Stock
        $total = [];
        $builder = $this->db->table("items");
        $builder->select('items.*');
        $item_stock = $builder->get()->getResult();

        foreach($item_stock as $key => $item) {
            $total[$key] = $item_stock[$key]->stock;
        }
        $total_stocks = array_sum($total);

        // Total Stock Sell
        $total_sell = [];
        $builder_sell = $this->db->table("supplier_items");
        $builder_sell->select('supplier_items.*');
        $item_stock_sell = $builder_sell->get()->getResult();

        foreach($item_stock_sell as $key => $item_sell) {
            $total_sell[$key] = $item_stock_sell[$key]->stock;
        }
        $total_stock_sells = array_sum($total_sell);

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();
 
        $data = array(
            'title' => 'Dashboard',
            'name_site' => $name_sites[0]->name_site,
            'total_items' => count($items),
            'total_stocks' => $total_stocks,
            'total_stock_sells' => $total_stock_sells,
            'total_types' => count($types),
            // 'limit_stock' => $limit_stock
        );
        return view('pages/home', $data);
    }

    public function setting()
    {


        $items = $this->settingSiteModel->findAll();
        foreach($items as $key => $item) {
            $items = $item;
        }
        
        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = array(
            'title' => 'Setting',
            'type' => 'setting',
            'data' => $items,
            'name_site' => $name_sites[0]->name_site
        );
        return view('pages/setting', $data);
    }

    public function updateSetting()
    {
        $id = 1;
        $items = new SettingSiteModel();
        $items->update($id, [
            'name_site'  => $this->request->getPost('name_site'),
            'address_site' => $this->request->getPost('address_site'),
            'telepone_site' => $this->request->getPost('telepone_site')
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('setting'));
    }
}
