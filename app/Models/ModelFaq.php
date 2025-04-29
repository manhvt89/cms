<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFaq extends Model
{
    protected $db;
    protected $table            = 'tbl_faq';
    protected $primaryKey       = 'faq_id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function all_faq($langId = 5)
    {
        if ($langId === null && session()->has('sess_lang_id')) {
            $langId = session('sess_lang_id');
        }
    
        $builder = $this->db->table('tbl_faq')
            ->where('lang_id', $langId)
            ->orderBy('faq_id', 'desc');
    
        $query = $builder->get();
        return $query->getResultArray(); // hoặc getResultArray() nếu bạn muốn array
    }

}