<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PortfolioModel extends Model
{
    protected $db;
    protected $table = 'tbl_portfolio';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name'             
        ,'short_content'    
        ,'content'          
        ,'client_name'      
        ,'client_company'   
        ,'start_date'       
        ,'end_date'         
        ,'website'          
        ,'cost'             
        ,'client_comment'   
        ,'category_id'      
        ,'photo'            
        ,'meta_title'       
        ,'meta_keyword'     
        ,'meta_description' 
        ,'lang_id'          
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

    function get_auto_increment_id1()
    {
        $query = $this->db->query("SHOW TABLE STATUS LIKE 'tbl_portfolio_photo'");
        return $query->getResultArray();
    }

    // ✅ Hàm: show
    public function show()
    {
        
        return $this->db->table('tbl_portfolio t1')
                ->join('tbl_portfolio_category t2', 't1.category_id = t2.category_id')
                ->join('tbl_lang t3', 't1.lang_id = t3.lang_id')
                ->orderBy('t1.id', 'ASC')
                ->get()
                ->getResultArray();

    }


    public function get_all_photos_by_category_id($id)
    {
        return $this->db->table('tbl_portfolio_photo')
                ->where('portfolio_id',$id)
                ->get()
                ->getResultArray();
       
    }

    function get_all_photo_category()
    {
        return $this->db->table('tbl_portfolio_category')
                    ->orderBy('category_id', 'ASC')
                    ->get()
                    ->getResultArray();
    }

    // ✅ Hàm: add
    public function add($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function add_photos($data) {
        $this->db->table('tbl_portfolio_photo')->insert($data);
        return $this->insertID();
    }

    // ✅ Hàm: update
    public function _update($id, $data)
    {
        return $this->where($this->primaryKey, $id)->set($data)->update();
    }

    // ✅ Hàm: delete
    public function _delete($id)
    {
        return $this->table('tbl_portfolio')
                    ->where('id', $id)
                    ->delete();
    }
    

    function delete_photos($id)
    {
        return $this->table('tbl_portfolio_photo')
            ->where('portfolio_id', $id)
            ->delete();
        
    }

    // ✅ Hàm: getData
    public function getData($id)
    {
        return $this->where('id', $id)->first();
    }

    // ✅ Hàm: event_check
    public function item_check($id)
    {
        return $this->getData($id);
    }

    public function portfolio_photo_by_id($id)
    {
        return $this->db->table('tbl_portfolio_photo')
                        ->where('id',$id)
                        ->get()
                        ->getFirstRow('array');
    }
    public function delete_portfolio_photo($id)
    {
        return $this->db->table('tbl_portfolio_photo')
                        ->where('id',$id)
                        ->delete();
    }
}
