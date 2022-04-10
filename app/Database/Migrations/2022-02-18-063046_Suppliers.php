<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Suppliers extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_supplier' => [
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
            'name_pic' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'telepone_pic' => [
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
        $this->forge->addPrimaryKey('id_supplier', true);
        $this->forge->createTable('suppliers');
    }

    public function down()
    {
        //
        $this->forge->dropTable('suppliers');
    }
}
