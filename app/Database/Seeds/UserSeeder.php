<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    public function run()
    {
        $table = 'users';
        if($this->db->table($table)->countAll() > 0){
            log_message('error', "$table seed failed, double seeding...");
            return false;
        }

        $uuid = Uuid::uuid4();
        $data['id'] = $uuid->toString();
        $data['email'] = 'halo.trisnasejati@gmail.com';
        $data['phone'] = '6287719734045';
        $data['password'] = password_hash('rindu', PASSWORD_DEFAULT);
        $data['full_name'] = 'Trisnawan';
        $data['birth_date'] = '2000-04-19';
        $data['gender'] = 'male';
        $this->db->table($table)->insert($data);

        $admin['user_id'] = $data['id'];
        $admin['position'] = 'Admin';
        $this->db->table('admin')->insert($admin);
    }
}
