<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductUuidToProduct extends Migration
{
    public function up()
    {
        // Thêm cột product_uuid
        $product_uuid = [
            'product_uuid' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,     // Tạm thời cho phép null
                'after'      => 'product_id'
            ]
        ];
        $this->forge->addColumn('tbl_product', $product_uuid);
    }

    public function down()
    {
        // Xóa cột nếu rollback
        $this->forge->dropColumn('tbl_product', 'product_uuid');
    }
}
