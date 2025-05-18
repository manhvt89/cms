<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ModelCategory extends Model
{
    protected $db;
    protected $table = 'tbl_category';
    protected $primaryKey = 'category_id';
    protected $allowedFields = [
        'category_name', 'category_banner', 'meta_title',
        'meta_keyword', 'meta_description', 'lang_id'
    ];

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

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
    
    protected $beforeInsert     = ['generateSlug'];
    protected $beforeUpdate     = ['generateSlug'];
    protected $afterInsert    = [];
    
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

    protected function generateSlug(array $data)
    {
        helper(['local']); // dùng 

        if (isset($data['data']['category_name'])) {
            $slug = slugify($data['data']['category_name']);
            $data['data']['category_slug'] = $slug;
        }

        return $data;
    }
    public function show() {
        
        return $this->db->table('tbl_category t1')
                    ->join('tbl_lang t2','t1.lang_id = t2.lang_id')
                    ->orderBy('t1.category_id','ASC')
                    ->get()
                    ->getResultArray();
    }

    public function add($data)
    {
        $this->table('tbl_category')->insert($data);
        return $this->getInsertID();
    }

    public function _update($id, $data)
    {
        return $this->table('tbl_category')->where('category_id', $id)->set($data)->update();
    }

    public function _delete($id)
    {
        return $this->table('tbl_category')->where('category_id', $id)->delete();
    }


    public function get_category($id)
    {
        return $this->db->table('tbl_category')
                ->where('category_id',$id)
                ->get()
                ->getFirstRow('array');
        
    }

    public function category_check($id)
    {
        return $this->db->table('tbl_category')
                ->where('category_id',$id)
                ->get()
                ->getFirstRow('array');
    }

    public function check_news($id) {
        return $this->db->table('tbl_news')
                ->where('category_id',$id)
                ->countAllResults();
        
    }
}
