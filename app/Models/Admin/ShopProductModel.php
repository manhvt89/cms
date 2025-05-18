<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ShopProductModel extends Model
{
    protected $db;
    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';
    protected $allowedFields = [
        'product_title'            
       ,'product_long_description'     
       ,'product_image'
       ,'product_slug'
       ,'product_keyword'           
       ,'product_short_description'  
       ,'product_price'         
       ,'product_quantity' 
       ,'product_feature'
       ,'product_category'
       ,'product_brand'
       ,'product_author'
       ,'product_view'
       ,'published_date'
       ,'publication_status',
       'product_uuid'
    ];

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
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
    protected $beforeInsert   = ['addUUID'];
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
    
    

    protected function addUUID(array $data)
    {
        $db = \Config\Database::connect();
        $uuid = $db->query("SELECT UUID() AS uuid")->getRow()->uuid;

        $data['data']['product_uuid'] = $uuid;

        return $data;
    }

    function get_auto_increment_id()
    {
        $query = $this->db->query("SHOW TABLE STATUS LIKE '{$this->table}'");
        return $query->getResultArray();
    }

    public function show() {
        return $this->db->table("tbl_product p")
                    ->select('*,p.publication_status as pstatus')
                    ->join('tbl_shop_category c', 'c.id=p.product_category')
                    ->join('tbl_brand b', 'b.brand_id=p.product_brand')
                    ->orderBy('p.product_id', 'DESC')
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
        return $this->db->table("tbl_product p")
                    ->select('*,p.publication_status as pstatus')
                    ->join('tbl_shop_category c', 'c.id=p.product_category')
                    ->join('tbl_brand b', 'b.brand_id=p.product_brand')
                    ->where('p.product_id', $id)
                    ->get()
                    ->getFirstRow('array');
    }

    public function item_check($id)
    {
        return $this->getData($id);
    }

    public function check_order($id)
    {
        return $this->db->table('tbl_order_details')
                ->where('product_id',$id)
                ->countAllResults();
    }

    public function get_all_published_category()
    {
        return $this->db->table('tbl_shop_category')
                    ->where('publication_status', 1)
                    ->get()
                    ->getResultArray();
    }

    public function get_all_published_brand()
    {
        return $this->db->table('tbl_brand')
                    ->where('publication_status', 1)
                    ->get()
                    ->getResultArray();
    }
}
