<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ShopBrandModel extends Model
{
    protected $db;
    protected $table = 'tbl_brand';
    protected $primaryKey = 'brand_id';
    protected $allowedFields = [
        'brand_name'            
       ,'brand_logo'     
       ,'brand_slug'           
       ,'brand_description'  
       ,'brand_keyword'         
       ,'publication_status'        
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
        $query = $this->db->query("SHOW TABLE STATUS LIKE '{$this->table}'");
        return $query->getResultArray();
    }

    public function show() {
        return $this->orderBy($this->primaryKey,'ASC')
                    ->get()
                    ->getResultArray();
        
    }

    public function _update($menu_id,$data) {
        return $this->where($this->primaryKey, $menu_id)->set($data)->update();
    }

    public function add($data) {
        $this->insert($data);
        return $this->insertID();
    }

    public function _delete($id)
    {
        return $this->where($this->primaryKey, $id)
                    ->delete();
    }

    public function getData($id)
    {
        return $this->where($this->primaryKey, $id)->first();
    }

    public function item_check($id)
    {
        return $this->getData($id);
    }

    public function check_product($id)
    {
        return $this->db->table('tbl_product')
                ->where('product_category',$id)
                ->countAllResults();
    }
}
