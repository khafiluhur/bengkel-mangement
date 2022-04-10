<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table = "customers";
    protected $primaryKey = "id";
    // protected $useTimestamps = true;
    protected $allowedFields = ['id','name','plat_nomor','type_motor'];
}
