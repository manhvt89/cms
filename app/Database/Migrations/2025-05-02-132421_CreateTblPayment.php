<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblPayment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'payment_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'payment_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'actions' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'pending',
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

        $this->forge->addKey('payment_id', true); // PRIMARY KEY
        $this->forge->createTable('tbl_payment');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_payment');
    }
}
