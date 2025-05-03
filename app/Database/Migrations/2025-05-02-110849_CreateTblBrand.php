<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblBrand extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'brand_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'brand_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'brand_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'brand_keyword' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'brand_description' => [
                'type' => 'TEXT',
            ],
            'publication_status' => [
                'type'       => 'TINYINT',
                'constraint' => 4,
                'default'    => 1,
            ],
        ]);

        $this->forge->addKey('brand_id', true); // PRIMARY KEY
        $this->forge->createTable('tbl_brand');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tbl_brand');
    }
}
