<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        //
        $data = [
            'username' => 'admin',
            'name'     => 'admin bengkel',
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'email'    => 'admin@bengkel.com',
            'id_level' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $this->db->table('users')->insert($data);
    }
}
