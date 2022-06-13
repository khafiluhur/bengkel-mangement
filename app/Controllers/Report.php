<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\ItemsModel;
use App\Models\CustomersModel;
use App\Models\TypeItemsModel;
use App\Models\MerkItemsModel;
use App\Controllers\BaseController;
use App\Models\CheckSuppliersModel;
use Dompdf\Dompdf;

class Report extends BaseController
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->userModel = new UsersModel();
        $this->itemModel = new ItemsModel();
        // $this->load = Load
        $this->checkSupplierModel = new CheckSuppliersModel();
        $this->customerModel = new CustomersModel();
        $this->typeItemModel = new TypeItemsModel();
        $this->merkItemModel = new MerkItemsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Report',
            'type' => 'report'
        ];
        return view('pages/report', $data);
    }

    public function historyCustomer()
    {
        $code_order = '';
        $customer = '';
        $plat = '';
        $items = [];

        if($_SERVER['QUERY_STRING']) {
            $keyword1 = explode("&",$_SERVER['QUERY_STRING']);
            
            // code_order
            $keyword2 = explode("=",$keyword1[0]);
            $code_order = $keyword2[1];

            // plat number
            $keyword5 = explode("=",$keyword1[1]);
            $keyword6 = explode("+",$keyword5[1]);
            $plat = join(" ",$keyword6);
            // dd($plat);
               
            if($code_order == $code_order && $plat == $plat) {
                $builder = $this->db->table("check_suppliers");
                $builder->select('check_suppliers.*, customers.name as nama_customer, customers.code as code_customer, customers.plat_nomor, customers.type_motor');
                $builder->join('customers', 'check_suppliers.customer = customers.id');
                $builder->like('check_suppliers.code_order', $code_order);
                $builder->orLike('customers.plat_nomor', $plat);
                $items = $builder->get()->getResult();
            } elseif($code_order == $code_order && $plat == "") {
                $builder = $this->db->table("check_suppliers");
                $builder->select('check_suppliers.*, customers.name as nama_customer, customers.code as code_customer, customers.plat_nomor, customers.type_motor');
                $builder->join('customers', 'check_suppliers.customer = customers.id');
                $builder->where('check_suppliers.code_order', $code_order);
                $items = $builder->get()->getResult();
            } elseif($code_order == "" && $plat == $plat) {
                $builder = $this->db->table("check_suppliers");
                $builder->select('check_suppliers.*, customers.name as nama_customer, customers.code as code_customer, customers.plat_nomor, customers.type_motor');
                $builder->join('customers', 'check_suppliers.customer = customers.id');
                $builder->where('customers.plat_nomor', $plat);
                $items = $builder->get()->getResult();
            } else {
                $builder = $this->db->table("check_suppliers");
                $builder->select('check_suppliers.*, customers.name as nama_customer, customers.code as code_customer, customers.plat_nomor, customers.type_motor');
                $builder->join('customers', 'check_suppliers.customer = customers.id');
                $items = $builder->get()->getResult();
            }
        }
        
        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $customers = $this->customerModel->findAll();

        $data = [
            'title' => 'Report Riwayat Pelanggan',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'reporet',
            'items' => $items,
            'customers' => $customers,
            'keyword_code_orders' => $code_order,
            'keyword_customers' => $customer,
        ];
        return view('pages/report', $data);
    }

    public function cetakhc()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $code_order = '';
        $customer = '';

        if($_SERVER['QUERY_STRING']) {
            $keyword1 = explode("&",$_SERVER['QUERY_STRING']);
            // code_order
            $keyword2 = explode("=",$keyword1[0]);
            if($keyword2 == '') {
                $code_order = 'All';
            } else {
                $code_order = $keyword2[1];
            }
            
            // customer
            $keyword3 = explode("=",$keyword1[1]);
            $keyword4 = explode("+",$keyword3[1]);
            $customer = join(" ",$keyword4);
        }

        $builder = $this->db->table("check_suppliers");
        $builder->select('check_suppliers.*, customers.name as nama_customer, customers.code as code_customer, customers.plat_nomor, customers.type_motor');
        $builder->join('customers', 'check_suppliers.customer = customers.id');
        $builder->like('check_suppliers.code_order', $code_order);
        $builder->orLike('customers.name', $customer);
        $items = $builder->get()->getResult();

        $filename = 'riwayat_service_pelanggan';

        // load HTML content
        $dompdf->loadHtml(view('/pages/report/print/cetak-hc', ['items' => $items, 'code' => $code_order, 'customers' => $customer]));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }

    public function listItem()
    {
        $name = '';
        $type = '';
        $merk = '';
        $items = '';

        if($_SERVER['QUERY_STRING']) {
            $keyword1 = explode("&",$_SERVER['QUERY_STRING']);
            // name items
            $keyword2 = explode("=",$keyword1[0]);
            $name = $keyword2[1];
            // type items
            $keyword3 = explode("=",$keyword1[1]);
            $type = $keyword3[1];
            // merk items
            $keyword4 = explode("=",$keyword1[2]);
            $merk = $keyword4[1];

            if($name == 'All' && $type == 'All' && $merk == 'All') {
                $builder = $this->db->table("items");
                $builder->select('items.*');
                $items = $builder->get()->getResult();
            } else {
                $builder = $this->db->table("items");
                $builder->select('items.*');
                $builder->like('code', $name);
                $builder->orLike('id_type', $type);
                $builder->orLike('id_merk', $merk);
                $items = $builder->get()->getResult();
            }

        }
        
        $selectItems = $this->itemModel->findAll();
        $selectTypes = $this->typeItemModel->findAll();
        $selectMerks = $this->merkItemModel->findAll();

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = [
            'title' => 'Report Daftar Barang',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'reporetItem',
            'selectItems' => $selectItems,
            'selectTypes' => $selectTypes,
            'selectMerks' => $selectMerks,
            'items' => $items,
        ];
        return view('pages/report/list_item', $data);
    }

    public function cetakli()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $name = '';
        $type = '';
        $merk = '';
        $items = '';

        // dd($_SERVER['QUERY_STRING']);

        if($_SERVER['QUERY_STRING']) {
            $keyword1 = explode("&",$_SERVER['QUERY_STRING']);
            // name items
            $keyword2 = explode("=",$keyword1[0]);
            $name = $keyword2[1];
            // type items
            $keyword3 = explode("=",$keyword1[1]);
            $type = $keyword3[1];
            // merk items
            $keyword4 = explode("=",$keyword1[2]);
            $merk = $keyword4[1];

            if($name == 'All' && $type == 'All' && $merk == 'All') {
                $builder = $this->db->table("items");
                $builder->select('items.*');
                $items = $builder->get()->getResult();
            } else {
                $builder = $this->db->table("items");
                $builder->select('items.*');
                $builder->like('code', $name);
                $builder->orLike('id_type', $type);
                $builder->orLike('id_merk', $merk);
                $items = $builder->get()->getResult();
            }
        }  

        $total = [];
        foreach($items as $key => $item) {
            $total[$key] = $items[$key]->stock * $items[$key]->price;
        }
        $total_price = array_sum($total);

        $filename = 'List Barang';

            // load HTML content
            $dompdf->loadHtml(view('/pages/report/print/cetak-li', ['items' => $items, 'total' => $total_price, 'name' => $name, 'type' => $type, 'merk' => $merk]));

            // (optional) setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // render html as PDF
            $dompdf->render();

            // output the generated pdf
            $dompdf->stream($filename);
    }

    public function cardStock()
    {
        $name = '';
        $first_date = '';
        $second_date = '';

        if($_SERVER['QUERY_STRING']) {
            $keyword1 = explode("&",$_SERVER['QUERY_STRING']);

            if($keyword1[1] == 'name=All') {
                $name = '';
                $first_date = '';
                $second_date = '';
            } else {
                // date
                $keyword2 = explode("=",$keyword1[0]);
                $keyword3 = explode("+",$keyword2[1]);
                $first_date = explode("%2F",$keyword3[0]);
                $first_date = $first_date[2].'-'.$first_date[0].'-'.$first_date[1];
                $second_date = explode("%2F",$keyword3[2]);
                $second_date = $second_date[2].'-'.$second_date[0].'-'.$second_date[1];
                //name 
                $keyword4 = explode("=",$keyword1[1]);
                $name = $keyword4[1];
            }
        }
    
        if($name == 'All') {
            $items = [];
        } else {
            $builder = $this->db->table("card_stocks");
            $builder->select('card_stocks.*');
            $builder->like('id_item', $name);
            $builder->where('date >=', $first_date);
            $builder->where('date <=', $second_date);
            $items = $builder->get()->getResult();
        }

        $selectItems = $this->itemModel->findAll();

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = [
            'title' => 'Report Kartu Stok',
            'name_site' => $name_sites[0]->name_site,
            'type' => 'cardStock',
            'items' => $items,
            'selectItems' => $selectItems,
            'keywords' => $name, 
        ];
        return view('pages/report/card_stock', $data);
    }

    public function cetakcs()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $keyword = '';

        if($_SERVER['QUERY_STRING']) {
            $keyword1 = explode("=",$_SERVER['QUERY_STRING']);
            $keyword2 = explode("+",$keyword1[1]);
            $keyword = join(" ",$keyword2);
        }
    
        if($keyword == 'All') {
            $items = [];
        } else {
            $builder = $this->db->table("card_stocks");
            $builder->select('card_stocks.*');
            $builder->like('id_item', $keyword);
            $items = $builder->get()->getResult();
        }

        $filename = 'Kartu Stok';

            // load HTML content
            $dompdf->loadHtml(view('/pages/report/print/cetak-cs', ['items' => $items, 'keyword' => $keyword]));

            // (optional) setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // render html as PDF
            $dompdf->render();

            // output the generated pdf
            $dompdf->stream($filename);
    }
}