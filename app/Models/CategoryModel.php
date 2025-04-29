<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $db;
    protected $table            = 'tbl_category';
    protected $primaryKey       = 'category_id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    public function all_news_by_category_id($id)
    {
        return $this->db->table('tbl_news')
                        ->where('category_id', $id)
                        ->orderBy('news_id', 'DESC')
                        ->get()
                        ->getResultArray();
    }

    public function category_by_id($id)
    {
        return $this->db->table($this->table)
                        ->where('category_id', $id)
                        ->get()
                        ->getRowArray();
    }

    public function category_check($id) {
        return $this->db->table($this->table)
                        ->where('category_id', $id)
                        ->countAllResults() > 0;
    }

}