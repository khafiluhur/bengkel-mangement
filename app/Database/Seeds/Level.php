<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Level extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'name' => 'admin',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'supplier',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ];

        $this->db->table('levels')->insertBatch($data);
    }
}
