<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Montirs extends Migration
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
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'telepone' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('montirs');
    }

    public function down()
    {
        //
        $this->forge->dropTable('montirs');
    }
}
