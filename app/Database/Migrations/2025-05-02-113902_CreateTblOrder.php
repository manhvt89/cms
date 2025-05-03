<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblOrder extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'order_id' => [
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
            'shipping_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'payment_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'order_total' => [
                'type'       => 'FLOAT',
                'null'       => false,
            ],
            'actions' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'Pending',
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

        $this->forge->addKey('order_id', true); // PRIMARY KEY
        $this->forge->createTable('tbl_order');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_order');
    }
}
