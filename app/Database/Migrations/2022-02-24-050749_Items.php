<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Items extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_item' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'price' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'size' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'id_type' => [
                'type' => 'INT',
                'constraint' => '12',
                'null' => true
            ],
            'id_supplier' => [
                'type' => 'INT',
                'constraint' => '12',
                'null' => true
            ],
            'id_merk' => [
                'type' => 'INT',
                'constraint' => '12',
                'null' => true
            ],
            'stock' => [
                'type' => 'INT',
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
        $this->forge->addPrimaryKey('id_item', true);
        $this->forge->createTable('items');
    }

    public function down()
    {
        //
        $this->forge->dropTable('items');
    }
}
