<?php

namespace App\Models;

use CodeIgniter\Model;

class SuppliersModel extends Model
{
    protected $table = "suppliers";
    protected $primaryKey = "id_supplier";
    protected $useTimestamps = true;
    protected $allowedFields = ['id_supplier','code','name','name_pic','telepone_pic','alamat'];
}
