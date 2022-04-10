<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeItemsModel extends Model
{
    protected $table = "type_items";
    protected $primaryKey = "id_type";
    protected $useTimestamps = true;
    protected $allowedFields = ['id_type','name'];
}
