<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $db;
    protected $table = 'tbl_menu';
    protected $primaryKey = 'menu_id';
    protected $allowedFields = [
        'menu_name','menu_status',
        'title','url','parent_id','position','sort_order','target','icon'    
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
    public function show() {
        return $this->findAll();
    }

    public function _update($menu_id,$data) {
        return $this->where($this->primaryKey, $menu_id)->set($data)->update();
    }
}
