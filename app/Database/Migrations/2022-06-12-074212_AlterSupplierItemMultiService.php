<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterSupplierItemMultiService extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('check_suppliers', [
            'service1' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'service2' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
		]);
    }

    public function down()
    {
        //
        $fields = array(
            'service1' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'service2' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
        );
        $this->forge->dropColumn('check_suppliers', $fields);
    }
}
