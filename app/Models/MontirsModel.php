<?php

namespace App\Models;

use CodeIgniter\Model;

class MontirsModel extends Model
{
    protected $table = "montirs";
    protected $primaryKey = "id";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','nip','name','telepone','alamat'];
}
