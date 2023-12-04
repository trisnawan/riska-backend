<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Course extends Migration
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
                'constraint' => 60
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
            'price' => [
                'type' => 'DOUBLE',
                'default' => 0
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['open','close'],
                'default' => 'open'
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['offline','online'],
                'default' => 'offline'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('courses', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('courses');
    }
}
