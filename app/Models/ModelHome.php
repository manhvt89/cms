<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHome extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }


    public function all_slider($langId=5)
    {
        return $this->db->table('tbl_slider')
                    ->where('lang_id', $langId)
                    ->orderBy('id', 'ASC')
                    ->get()
                    ->getResultArray();
    }
    public function all_service($langId=5)
    {
        return $this->db->table('tbl_service')
                    ->where('lang_id', $langId)
                    ->orderBy('id', 'ASC')
                    ->get()
                    ->getResultArray();
    }
    public function all_feature($langId=5)
    {
        return $this->db->table('tbl_feature')
                        ->where('lang_id',$langId)
                        ->orderBy('id','ASC')
                        ->get()
                        ->getResultArray();

    }
    public function all_why_choose($langId=5)
    {
        return $this->db->table('tbl_why_choose')
                        ->where('lang_id',$langId)
                        ->orderBy('id','ASC')
                        ->get()
                        ->getResultArray();
        
    }
    public function all_team_member($langId=5)
    {
        return $this->db->table('tbl_team_member')
                        ->where('lang_id',$langId)
                        ->orderBy('id','ASC')
                        ->get()
                        ->getResultArray();
    }
    public function all_testimonial($langId=5)
    {
        return $this->db->table('tbl_testimonial')
                        ->where('lang_id',$langId)
                        ->orderBy('id','ASC')
                        ->get()
                        ->getResultArray();
    }
    public function all_client()
    {
        return $this->db->table('tbl_client')
                        ->orderBy('id','ASC')
                        ->get()
                        ->getResultArray();
       
    }
    public function all_pricing_table($langId=5)
    {
        return $this->db->table('tbl_pricing_table')
                        ->where('lang_id',$langId)
                        ->orderBy('id','ASC')
                        ->get()
                        ->getResultArray();
        
    }
    public function all_faq_home($langId=5)
    {
        return $this->db
                ->table('tbl_faq')
                ->where('show_on_home', 'Yes')
                ->where('lang_id', $langId)
                ->get()
                ->getResultArray();
    }
}