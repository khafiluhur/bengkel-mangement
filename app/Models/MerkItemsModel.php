<?php

namespace App\Models;

use CodeIgniter\Model;

class MerkItemsModel extends Model
{
    protected $table = "merk_items";
    protected $primaryKey = "id_merk";
    protected $useTimestamps = true;
    protected $allowedFields = ['id_merk','name'];
}
