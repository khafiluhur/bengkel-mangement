<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterItems extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('items', [
            'limit_stock' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => '3',
            ]
		]);

    }

    public function down()
    {
        //
        $this->forge->dropColumn('items', 'limit_stock');
    }
}
