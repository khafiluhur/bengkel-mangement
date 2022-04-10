<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CheckIns extends Migration
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
            'id_item' => [
                'type' => 'INT',
                'constraint' => '12',
                'unsigned' => true,
                'null' => true
            ],
            'id_supplier' => [
                'type' => 'INT',
                'constraint' => '12',
                'null' => true
            ],
            'stock' => [
                'type' => 'INT',
                'constraint' => '100'
            ],
            'price' => [
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
        $this->forge->createTable('check_ins');
    }

    public function down()
    {
        //
        $this->forge->dropTable('check_ins');
    }
}
