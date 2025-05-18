<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $db;
    protected $table            = 'tbl_page';
    protected $primaryKey       = 'page_id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    public function page_check($slug)
    {
        return $this->db->table('tbl_page_dynamic')
            ->where('slug', $slug)
            ->countAllResults();
    }

    public function dynamic_page_by_slug($slug)
    {
        return $this->db->table('tbl_page_dynamic')
            ->where('slug', $slug)
            ->get()
            ->getRowArray();
    }


}