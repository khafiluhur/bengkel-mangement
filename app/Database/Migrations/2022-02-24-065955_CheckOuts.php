<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CheckOuts extends Migration
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
                'null' => true
            ],
            'date_out' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
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
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('check_outs');
    }

    public function down()
    {
        //
        $this->forge->dropTable('check_outs');
    }
}
