<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TypeItems extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_type' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
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
        $this->forge->addPrimaryKey('id_type', true);
        $this->forge->createTable('type_items');
    }

    public function down()
    {
        //
        $this->forge->dropTable('type_items');
    }
}
