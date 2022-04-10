<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customers extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'plat_nomor' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'type_motor' => [
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
        $this->forge->createTable('customers');
    }

    public function down()
    {
        //
        $this->forge->dropTable('customers');
    }
}
