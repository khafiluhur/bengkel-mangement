<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CheckSuppliers extends Migration
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
            'date_trasanction' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'total_pay' => [
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
        $this->forge->createTable('check_suppliers');
    }

    public function down()
    {
        //
        $this->forge->dropTable('check_suppliers');
    }
}
