<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblShipping extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'shipping_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'customer_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'shipping_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'shipping_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'shipping_address' => [
                'type' => 'TEXT',
            ],
            'shipping_city' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'shipping_country' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'shipping_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'shipping_zipcode' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
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

        $this->forge->addKey('shipping_id', true); // PRIMARY KEY
        // Nếu cần có ràng buộc khóa ngoại đến bảng tbl_customer:
        // $this->forge->addForeignKey('customer_id', 'tbl_customer', 'customer_id');

        $this->forge->createTable('tbl_shipping');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_shipping');
    }
}
