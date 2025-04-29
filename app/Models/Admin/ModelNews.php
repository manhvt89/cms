<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ModelNews extends Model
{
    protected $db;
    protected $table = 'tbl_news';
    protected $primaryKey = 'news_id';
    protected $allowedFields = [
        'news_title', 'news_content', 'news_date',
        'news_content_short', 'photo', 'banner',
        'news_id','category_id','meta_title',
        'meta_keyword','meta_description','lang_id'
    ];

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    public function show() {
        
        return $this->db->table('tbl_news t1')
            ->select('
                t1.news_id,
                t1.news_title,
                t1.news_content,
                t1.photo,
                t1.banner,
                t1.category_id,
                t1.lang_id,
                t2.category_name,
                t3.lang_name
            ')
            ->join('tbl_category t2', 't1.category_id = t2.category_id')
            ->join('tbl_lang t3', 't1.lang_id = t3.lang_id')
            ->where('t1.deleted_at IS NULL')
            ->orderBy('t1.news_id', 'DESC')
            ->get()
            ->getResultArray();
        /*
        return $this->select('
                    tbl_news.news_id,
                    tbl_news.news_title,
                    tbl_news.news_content,
                    tbl_news.photo,
                    tbl_news.banner,
                    tbl_news.category_id,
                    tbl_news.lang_id,
                    tbl_category.category_name,
                    tbl_lang.lang_name
                ')
                ->join('tbl_category', 'tbl_news.category_id = tbl_category.category_id')
                ->join('tbl_lang', 'tbl_news.lang_id = tbl_lang.lang_id')
                ->orderBy('tbl_news.news_id', 'DESC')
                ->findAll();
            */
    }

    public function add($data)
    {
        $this->table('tbl_news')->insert($data);
        return $this->getInsertID();
    }

    public function getData($id)
    {
        return $this->db->table('tbl_news')
                ->where('news_id',$id)
                ->get()
                ->getFirstRow('array');
    }

    public function _update($id, $data)
    {
        return $this->table('tbl_news')->where('news_id', $id)->set($data)->update();
    }

    public function _delete($id)
    {
        return $this->table('tbl_news')->where('news_id', $id)->delete();
    }


    public function get_category()
    {
        return $this->db->table('tbl_category')
                ->get()
                ->getResultArray('array');
        
    }

    public function category_check($id)
    {
        return $this->db->table('tbl_category')
                ->where('category_id',$id)
                ->get()
                ->getFirstRow('array');
    }

    public function check_news($id) {
        return $this->db->table('tbl_news')
                ->where('category_id',$id)
                ->countAllResults();
        
    }
}
