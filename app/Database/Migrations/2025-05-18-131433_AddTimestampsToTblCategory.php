<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsToTblCategory extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_category', [
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_category', ['created_at', 'updated_at']);
    }
}
