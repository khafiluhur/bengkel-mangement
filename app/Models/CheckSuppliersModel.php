<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckSuppliersModel extends Model
{
    protected $table = "check_suppliers";
    protected $primaryKey = "id";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','customer','montir','code_order','date_trasanction','total_pay','crash','crashrepair1','crashrepair2','crashrepair3'];
}
