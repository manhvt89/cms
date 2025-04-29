<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $db;
    protected $table            = 'tbl_page_contact';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    public function all_testimonial()
    {
        return $this->db->table('tbl_testimonial')
        ->orderBy('id', 'ASC')
        ->get()
        ->getResultArray();
    }

    public function check_captcha()
    {
        return $this->db->table('tbl_setting_captcha')
                        ->where('id', 1)
                        ->get()
                        ->getRowArray();
    }

    public function total_captcha()
    {
    	return $this->db->table('tbl_captcha')->countAllResults();
    }

    public function get_particular_captcha($id)
    {
    	return $this->db->table('tbl_captcha')
                        ->where('captcha_id', $id)
                        ->get()
                        ->getRowArray();
    }

}