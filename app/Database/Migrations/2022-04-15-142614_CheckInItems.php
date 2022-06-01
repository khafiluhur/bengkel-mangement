<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CheckInItems extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'code_order' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'id_item' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'price' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'stock' => [
                'type' => 'INT',
                'constraint' => '100'
            ],
            'id_supplier' => [
                'type' => 'INT',
                'constraint' => '12',
                'null' => true
            ],
            'subtotal' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ]
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('check_in_items');
    }

    public function down()
    {
        //
        $this->forge->dropTable('check_in_items');
    }
}
