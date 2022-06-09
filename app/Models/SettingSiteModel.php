<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingSiteModel extends Model
{
    protected $table = "setting_sites";
    protected $primaryKey = "id";
    protected $allowedFields = ['id','name_site','address_site','telepone_site'];
}
