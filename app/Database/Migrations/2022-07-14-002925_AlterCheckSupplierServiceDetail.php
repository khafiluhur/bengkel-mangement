<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCheckSupplierServiceDetail extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('check_suppliers', [
            'service_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'service_price' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'service_name1' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'service_price1' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'service_name2' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'service_price2' => [
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
            'service_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'service_price' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'service_name1' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'service_price1' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'service_name2' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'service_price2' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
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
    }
}
