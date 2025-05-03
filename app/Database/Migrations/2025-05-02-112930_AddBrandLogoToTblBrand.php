<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBrandLogoToTblBrand extends Migration
{
    public function up()
    {
        $fields = [
            'brand_logo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'brand_name' // chỉ định vị trí nếu cần
            ],
        ];

        $this->forge->addColumn('tbl_brand', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_brand', 'brand_logo');
    }
}
