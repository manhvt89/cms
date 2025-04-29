<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PageHomeModel extends Model
{
    protected $db;
    protected $table = 'tbl_page_home';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $allowedFields = [];

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
        return $this->db->table('tbl_page_home t1')
                ->join('tbl_lang t2','t1.lang_id = t2.lang_id')
                ->orderBy($this->primaryKey,'ASC')
                ->get()
                ->getResultArray();
    }

    public function show_lang_independent()
    {
        return $this->db->table('tbl_page_home_lang_independent')
                ->where($this->primaryKey,1)
                ->get()
                ->getFirstRow('array');
    }

    

    // ✅ Hàm: update
    public function _update($id, $data)
    {
        return $this->where($this->primaryKey, $id)->set($data)->update();
    }

    // ✅ Hàm: delete
    public function _delete($id)
    {
        return $this->where($this->primaryKey, $id)
                    ->delete();
    }
    
    // ✅ Hàm: getData
    public function getData($id)
    {
        return $this->where($this->primaryKey, $id)->first();
    }

    // ✅ Hàm: event_check
    public function item_check($id)
    {
        return $this->getData($id);
    }
    
    public function update_home($data)
    {
        return $this->db->table('tbl_page_home_lang_independent')->where('id',1)
                    ->update($data);
    }
}
