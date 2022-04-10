<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemsModel extends Model
{
    protected $table = "items";
    protected $primaryKey = "id_item";
    protected $useTimestamps = true;
    protected $allowedFields = ['id_item','code','name','price','image','size','id_type','id_merk','id_supplier','stock'];
}
