<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterSupplierItems extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('supplier_items', [
            'discount' => [
                'type' => 'INT',
                'constraint' => '100'
            ],
            'plug' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
		]);
    }

    public function down()
    {
        //
        $fields = array(
            'discount' => array(
                'type' => 'INT',
                'constraint' => '100',
            ),
            'plug' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        );
        $this->forge->dropColumn('news', $fields);
    }
}
