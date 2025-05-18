<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategorySlugToTblCategory extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_category', [
            'category_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'category_name', // tuỳ vị trí bạn muốn
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_category', 'category_slug');
    }
}
