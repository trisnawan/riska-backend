<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Nilai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'member_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'nilai_akhir' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true,
                'default' => null
            ],
            'kelulusan' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'null' => true,
                'default' => null
            ],
            'sertifikat' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addForeignKey('member_id', 'course_member', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('nilai', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('nilai');
    }
}
