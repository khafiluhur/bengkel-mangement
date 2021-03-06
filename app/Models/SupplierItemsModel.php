<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierItemsModel extends Model
{
    protected $table = "supplier_items";
    protected $primaryKey = "id";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','code_order','id_item','stock','discount','plug','subtotal','code_item','name_item','price_item','size_item','merk_item','type_item'];
}
