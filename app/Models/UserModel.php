<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = ['insert_field'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = ['select_field'];
    protected $afterFind      = ['filter_output'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function insert_field(array $data){
        $uuid = Uuid::uuid4();
        $data['data']['id'] = $uuid->toString();
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    protected function select_field(array $data){
        $this->select('id, full_name, email, phone, birth_date, gender');
        $this->select('IF(admin.user_id IS NOT NULL, 1, 0) as is_admin');
        $this->join('admin', 'admin.user_id = users.id', 'left');
        return $data;
    }

    protected function filter_output(array $data){
        if(isset($data['data'][0])){
            foreach($data['data'] as $i => $d){
                $data['data'][$i]['is_admin'] = $d['is_admin'] > 0;
            }
        }

        if(isset($data['data']['id'])){
            $data['data']['is_admin'] = $data['data']['is_admin'] > 0;
        }
        return $data;
    }

    public function login($email, $password){
        $this->select('password');
        $user = $this->where('email', $email)->first();
        if(!$user) return null;

        if(password_verify($password, $user['password'])){
            unset($user['password']);
            return $user;
        }
        return null;
    }
}
