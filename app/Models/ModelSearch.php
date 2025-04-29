<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSearch extends Model
{
    protected $table      = 'tbl_news';
    protected $primaryKey = 'news_id';
    protected $useTimestamps = false;

    // Kết quả tìm kiếm
    public function search(string $keyword): array
    {
        $builder = $this->db->table('tbl_news t1');
        $builder->select('t1.*, t2.category_name');
        $builder->join('tbl_category t2', 't1.category_id = t2.category_id');
        $builder->groupStart()
                ->like('t1.news_title', $keyword)
                ->orLike('t1.news_content', $keyword)
                ->groupEnd();
        $builder->orderBy('t1.news_id', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // Tổng số kết quả
    public function search_total(string $keyword): int
    {
        $builder = $this->db->table('tbl_news t1');
        $builder->join('tbl_category t2', 't1.category_id = t2.category_id');
        $builder->groupStart()
                ->like('t1.news_title', $keyword)
                ->orLike('t1.news_content', $keyword)
                ->groupEnd();
        return $builder->countAllResults();
    }
}
