<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class KajianModel extends Model
{
    protected $table            = 'kajian';
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
    protected $beforeInsert   = ['insert_field'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = ['select_field'];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function insert_field(array $data){
        $uuid = Uuid::uuid4();
        $data['data']['id'] = $uuid->toString();
        return $data;
    }

    protected function select_field(array $data){
        $this->select('id, title, description, start_at, created_at');
        $this->select("CONCAT('".base_url('contents/kajian/')."', IFNULL(image, 'default.png')) as image");
        return $data;
    }
}
