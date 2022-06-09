<?php

namespace App\Models;

use CodeIgniter\Model;

class OtherCostModel extends Model
{
    protected $table = "other_costs";
    protected $primaryKey = "id";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','price'];
}
