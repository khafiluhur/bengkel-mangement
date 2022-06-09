<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SettingSites extends Migration
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
            'name_site' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'address_site' => [
                'type' => 'TEXT',
            ],
            'telepone_site' => [
                'type' => 'TEXT',
            ]
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('setting_sites');
    }

    public function down()
    {
        //
        $this->forge->dropTable('card_stocks');
    }
}
