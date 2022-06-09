<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Setting extends Seeder
{
    public function run()
    {
        //
        $data = [
            'name_site' => 'Bengkel Indonesia',
            'address_site' => 'Jl.Masjid Nurul Mutaqin.RT 003/004.Pekayon jaya Bekasi Selatan, RT.003/RW.026, Pekayon Jaya, Kec. Bekasi Sel., Kota Bks, Jawa Barat 17148',
            'telephone_site' => '081296409634',
        ];

        $this->db->table('setting_sites')->insert($data);
    }
}
