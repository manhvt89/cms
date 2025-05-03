<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblCustomer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'customer_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'customer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'customer_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'customer_password' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
            'customer_address' => [
                'type' => 'TEXT',
            ],
            'customer_city' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'customer_zipcode' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'customer_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'customer_country' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'customer_active' => [
                'type'       => 'TINYINT',
                'constraint' => 4,
                'comment'    => 'Active=1,Unactive=0',
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

        $this->forge->addKey('customer_id', true); // PRIMARY KEY
        $this->forge->addUniqueKey('customer_email'); // UNIQUE
        $this->forge->createTable('tbl_customer');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_customer');
    }
}
