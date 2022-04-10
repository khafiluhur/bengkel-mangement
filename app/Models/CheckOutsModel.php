<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckOutsModel extends Model
{
    protected $table = "check_outs";
    protected $primaryKey = "id";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','id_item','date_out','stock'];
}
