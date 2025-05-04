<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AllColumnsProduct extends Migration
{
    public function up()
    {
        $fields = [
            'product_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'product_image' // chỉ định vị trí nếu cần
            ],
            'product_keyword' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'product_image' // chỉ định vị trí nếu cần
            ],
        ];

        $this->forge->addColumn('tbl_product', $fields);
    }

    public function down()
    {
        //
    }
}
