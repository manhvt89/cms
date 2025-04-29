<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLang extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function get_default_language_id()
    {
        $builder = $this->db->table('tbl_lang');
        $query = $builder->getWhere(['lang_default' => 'Yes']);
        return $query->getFirstRow('array');
    }

    public function get_detail_by_language_id($id)
    {
        $builder = $this->db->table('tbl_lang_detail');
        $query = $builder->getWhere(['lang_id' => $id]);
        return $query->getResultArray();
    }

    public function show_all_language()
    {
        $builder = $this->db->table('tbl_lang');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_direction_by_lang_id($id)
    {
        $builder = $this->db->table('tbl_lang');
        $query = $builder->getWhere(['lang_id' => $id]);
        return $query->getFirstRow('array');
    }
}
