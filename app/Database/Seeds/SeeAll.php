<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeeAll extends Seeder
{
    public function run()
    {
        //
        $this->call('Level');
        $this->call('Users');
    }
}
