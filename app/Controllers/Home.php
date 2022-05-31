<?php

namespace App\Controllers;

use App\Models\ItemsModel;
use App\Models\TypeItemsModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->itemModel = new ItemsModel();
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

        $data = array(
            'title' => 'Dashboard',
            'total_items' => count($items),
            'total_stocks' => $total_stocks,
            'total_stock_sells' => $total_stock_sells,
            'total_types' => count($types),
        );
        return view('pages/home', $data);
    }
}
