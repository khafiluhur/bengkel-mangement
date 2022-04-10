<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','username','name','email','password','id_level'];

}
