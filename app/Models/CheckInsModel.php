<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckInsModel extends Model
{
    protected $table = "check_ins";
    protected $primaryKey = "id";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','id_item','id_supplier','stock','price'];
}
