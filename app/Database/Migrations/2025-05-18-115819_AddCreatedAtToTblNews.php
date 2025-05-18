<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedAtToTblNews extends Migration
{
   public function up()
    {
        $this->forge->addColumn('tbl_news', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'news_content' // đổi tên trường phù hợp nếu cần
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_news', 'created_at');
    }

}
