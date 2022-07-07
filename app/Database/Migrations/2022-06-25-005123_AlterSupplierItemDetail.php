<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterSupplierItemDetail extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('supplier_items', [
            'code_item' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'name_item' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'price_item' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'size_item' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'merk_item' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'type_item' => [
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
            'code_item' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'name_item' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'price_item' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'size_item' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'merk_item' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'type_item' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            )
          );
        $this->forge->dropColumn('news', $fields);
    }
}
