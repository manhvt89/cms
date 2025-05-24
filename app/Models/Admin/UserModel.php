<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $db;
    protected $table = 'tbl_user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'email'            
       ,'password'     
       ,'photo'           
       ,'token'          
       ,'role'        
       ,'status'           
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
    

    function get_auto_increment_id()
    {
        $query = $this->db->query("SHOW TABLE STATUS LIKE 'tbl_user'");
        return $query->getResultArray();
    }

    public function show() {
        return $this->db->table($this->table)
                    ->orderBy('id','ASC')
                    ->get()
                    ->getResultArray();
        
    }

    public function _update($id,$data) {
        return $this->where($this->primaryKey, $id)->set($data)->update();
    }

    public function add($data) {
        $this->insert($data);
        return $this->insertID();
    }

    public function _delete($id)
    {
        return $this->where('id', $id)
                    ->delete();
    }

    public function getData($id)
    {
        return $this->where('id', $id)->first();
    }

    public function item_check($id)
    {
        return $this->getData($id);
    }
}
