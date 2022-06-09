<?php

namespace App\Models;

use CodeIgniter\Model;

class DiscountModel extends Model
{
    protected $table = "discounts";
    protected $primaryKey = "id";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','value'];
}
