<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNewsSlugNews extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_news', [
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'news_title', // chỉ định thêm sau cột nào nếu muốn
                'null'       => true,
                'unique'     => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_news', 'slug');
    }
}
