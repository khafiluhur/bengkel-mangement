<?php

namespace App\Models;

use CodeIgniter\Model;

class LevelsModel extends Model
{
    protected $table = "levels";
    protected $primaryKey = "id_level";
    protected $useTimestamps = true;
    protected $allowedFields = ['id_level','name'];
}
