<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 40
            ],
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 30
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'default' => null
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
                'unique' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 250
            ],
            'birth_date' => [
                'type' => 'DATE',
                'null' => true,
                'default' => null
            ],
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['male', 'female'],
                'null' => true,
                'default' => null
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
