<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNews extends Model
{
    protected $db;
    protected $table            = 'tbl_news';
    protected $primaryKey       = 'news_id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function all_news($langId = 5)
    {
        if ($langId === null) {
            $langId = session('sess_lang_id');
        }
    
        return $this->db->table('tbl_news t1')
            ->join('tbl_category t2', 't1.category_id = t2.category_id')
            ->where('t1.lang_id', $langId)
            ->orderBy('t1.news_id', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function get_total_news($langId = null)
    {
        if ($langId === null) {
            $langId = session('sess_lang_id');
        }

        return $this->db->table('tbl_news')
            ->where('lang_id', $langId)
            ->countAllResults();
    }


    public function fetch_news($limit, $offset = 0, $langId = 5) {
        if ($langId === null && session()->has('sess_lang_id')) {
            $langId = session('sess_lang_id');
        }

        return $this->db->table('tbl_news t1')
            ->join('tbl_category t2', 't1.category_id = t2.category_id')
            ->where('t1.lang_id', $langId)
            ->orderBy('t1.news_id', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->getResultObject();
    }

    public function all_categories()
    {
        return $this->db->table('tbl_category')
                ->orderBy('category_name', 'DESC')
                ->get()
                ->getResultArray();
    }

    public function news_check($id)
    {
        return $this->db->table('tbl_news')
            ->where('news_id', $id)
            ->countAllResults(); // Trả về số dòng
    }

    public function news_detail($id)
    {
        return $this->db->table('tbl_news')
            ->where('news_id', $id)
            ->get()
            ->getRowArray();
    }

    public function news_detail_with_category($id)
    {
        return $this->db->table('tbl_news t1')
            ->join('tbl_category t2', 't1.category_id = t2.category_id')
            ->where('t1.news_id', $id)
            ->orderBy('t1.news_id', 'DESC')
            ->get()
            ->getRowArray();
    }

    public function get_category_name_by_id($cat_id)
    {
        return $this->db->table('tbl_category')
            ->where('category_id', $cat_id)
            ->get()
            ->getRowArray();
    }
}