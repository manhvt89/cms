<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblProduct extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'product_short_description' => [
                'type' => 'TEXT',
            ],
            'product_long_description' => [
                'type' => 'TEXT',
            ],
            'product_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'product_price' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'product_quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'product_feature' => [
                'type'       => 'TINYINT',
                'constraint' => 4,
            ],
            'product_category' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'product_brand' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'product_author' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'product_view' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'published_date' => [
                'type'    => 'DATETIME',
                'null' => false
                
            ],
            'publication_status' => [
                'type'       => 'TINYINT',
                'constraint' => 4,
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

        $this->forge->addKey('product_id', true); // PRIMARY KEY
        $this->forge->createTable('tbl_product');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_product');
    }
}
