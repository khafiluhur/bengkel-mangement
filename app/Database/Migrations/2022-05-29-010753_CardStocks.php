<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CardStocks extends Migration
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
            'date' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'information' => [
                'type' => 'TEXT',
            ],
            'id_item' => [
                'type' => 'TEXT',
            ],
            'stock_in' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => true
            ],
            'stock_out' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => true
            ],
            'saldo' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('card_stocks');
    }

    public function down()
    {
        //
        $this->forge->dropTable('card_stocks');
    }
}
