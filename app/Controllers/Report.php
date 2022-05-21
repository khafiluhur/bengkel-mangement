<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Controllers\BaseController;

class Report extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Report',
            'type' => 'report'
        ];
        return view('pages/report', $data);
    }
}