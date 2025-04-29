<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PageAboutModel extends Model
{
    protected $db;
    protected $table = 'tbl_page_about';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'about_heading',
				'about_content',
				'mt_about',
				'mk_about',
				'md_about'        
    ];

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

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

    // ✅ Hàm: get_auto_increment_id
    public function get_auto_increment_id()
    {
        $query = $this->db->query("SHOW TABLE STATUS LIKE '{$this->table}'");
        return $query->getResultArray();
    }

    // ✅ Hàm: show
    public function show()
    {
        return $this->db->table('tbl_page_about t1')
                ->join('tbl_lang t2','t1.lang_id = t2.lang_id')
                ->orderBy('id','ASC')
                ->get()
                ->getResultArray();
    }

    
    // ✅ Hàm: update
    public function _update($id, $data)
    {
        return $this->where($this->primaryKey, $id)->set($data)->update();
    }
    
    // ✅ Hàm: getData
    public function getData($id)
    {
        return $this->db->table("{$this->table} t1")
                    ->join("tbl_lang t2","t1.lang_id = t2.lang_id")
                    ->where($this->primaryKey, $id)
                    ->get()
                    ->getFirstRow('array');
    }

    // ✅ Hàm: event_check
    public function item_check($id)
    {
        return $this->getData($id);
    }

}
