<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblOrderDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'order_details_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'order_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'product_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'product_price' => [
                'type' => 'FLOAT',
            ],
            'product_sales_quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'product_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 55,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('order_details_id', true); // PRIMARY KEY
        $this->forge->createTable('tbl_order_details');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_order_details');
    }
}
