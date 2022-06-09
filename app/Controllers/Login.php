<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function index()
    {
        //
        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = array(
            'name_site' => $name_sites[0]->name_site,
        );

        return view('pages/login', $data);
    }
}
