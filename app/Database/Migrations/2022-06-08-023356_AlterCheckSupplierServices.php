<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCheckSupplierServices extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('check_suppliers', [
            'service' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ]
		]);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('news', 'service');
    }
}
