<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class CourseModel extends Model
{
    protected $table            = 'courses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    protected $useTimestamps = false;

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
        $this->select('id, title, description, price, status, type');
        $this->select("CONCAT('".base_url('contents/courses/')."', IFNULL(image, 'default.png')) as image");
        return $data;
    }
}
