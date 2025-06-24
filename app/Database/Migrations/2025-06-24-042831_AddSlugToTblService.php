<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSlugToTblService extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_service', [
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'name' // hoặc trường nào đó tuỳ bạn
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_service', 'slug');
    }
}
