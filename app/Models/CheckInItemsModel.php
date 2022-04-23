<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckInItemsModel extends Model
{
    protected $table = "check_in_items";
    protected $primaryKey = "id";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','code_order','id_item','price','stock','id_supplier','subtotal'];
}
