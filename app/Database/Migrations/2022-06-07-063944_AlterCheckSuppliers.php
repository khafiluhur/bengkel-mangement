<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCheckSuppliers extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('check_suppliers', [
            'discount' => [
                'type' => 'INT',
                'constraint' => '100'
            ]
		]);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('news', 'discount');
    }
}
