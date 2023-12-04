<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Kajian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 40
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 40
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 120
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'null' => true,
                'default' => null
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
                'default' => null
            ],
            'start_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kajian', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('kajian');
    }
}
