<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckSuppliersModel extends Model
{
    protected $table = "check_suppliers";
    protected $primaryKey = "id";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','customer','montir','code_order','date_trasanction','discount','service','service_name','service_price','service1','service_name1','service_price1','service2','service_name2','service_price2','total_pay','crash','crashrepair1','crashrepair2','crashrepair3'];
}