<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Pembayaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'member_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['unpaid', 'paid', 'cancel'],
                'default' => 'unpaid'
            ],
            'price' => [
                'type' => 'DOUBLE',
                'default' => 0
            ],
            'gateway_code' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'default' => null
            ],
            'gateway_link' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addForeignKey('member_id', 'course_member', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pembayaran', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran');
    }
}
