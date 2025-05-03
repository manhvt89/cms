<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblShopCategory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'category_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'category_photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'category_description' => [
                'type' => 'TEXT',
            ],
            'publication_status' => [
                'type'       => 'TINYINT',
                'constraint' => 4,
                'comment'    => 'Published=1,Unpublished=0',
            ],
        ]);

        $this->forge->addKey('id', true); // PRIMARY KEY
        $this->forge->createTable('tbl_shop_category');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_shop_category');
    }
}
