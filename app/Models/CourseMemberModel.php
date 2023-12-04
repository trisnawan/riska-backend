<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseMemberModel extends Model
{
    protected $table            = 'course_member';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
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
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = ['select_field'];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function select_field(array $data){
        $this->select('id, course_member.status, course_member.created_at');
        $this->select('courses.id as course_id, courses.title as course_title, courses.description as course_description, courses.price as course_price, courses.status as course_status, courses.type as course_type');
        $this->select("CONCAT('".base_url('contents/courses/')."', IFNULL(courses.image, 'default.png')) as course_image");
        $this->select('pembayaran.price as trx_price, pembayaran.status as trx_status, pembayaran.gateway_code, pembayaran.gateway_link');
        $this->select("nilai_akhir, IFNULL(kelulusan, 'Pembelajaran') as kelulusan, sertifikat");
        $this->join('courses', 'courses.id = course_member.course_id');
        $this->join('pembayaran', 'pembayaran.member_id = course_member.id', 'left');
        $this->join('nilai', 'nilai.member_id = course_member.id', 'left');
        return $data;
    }
}
