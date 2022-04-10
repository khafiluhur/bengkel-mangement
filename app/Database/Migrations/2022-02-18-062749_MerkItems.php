<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MerkItems extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_merk' => [
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
        $this->forge->addPrimaryKey('id_merk', true);
        $this->forge->createTable('merk_items');
    }

    public function down()
    {
        //
        $this->forge->dropTable('merk_items');
    }
}
