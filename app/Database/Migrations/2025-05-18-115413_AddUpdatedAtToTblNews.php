<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUpdatedAtToTblNews extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_news', [
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'readability_score' // nếu có
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_news', 'updated_at');
    }

}
