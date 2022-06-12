<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Setting extends Seeder
{
    public function run()
    {
        //
        $data = [
            'name_site' => 'Moteker Jaya Motor',
            'address_site' => 'Perumahan Puri Persada Indah Ruko No 18, Sindangmulya, Kec. Cibarusa, Kabupaten Bekasi, Jawa Barat',
            'telephone_site' => '081286460347',
        ];

        $this->db->table('setting_sites')->insert($data);
    }
}
