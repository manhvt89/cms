<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $db;
    protected $table = 'tbl_service';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name','photo','description','slug',
        'short_description','lang_id',
        'meta_title','meta_keyword','meta_description'
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
    
    protected $afterInsert    = [];
    
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    // ✅ Hàm: get_auto_increment_id
    

    function get_auto_increment_id()
    {
        $query = $this->db->query("SHOW TABLE STATUS LIKE 'tbl_portfolio_photo'");
        return $query->getResultArray();
    }

    public function show() {
        return $this->db->table('tbl_service t1')
                    ->join('tbl_lang t2','t1.lang_id = t2.lang_id')
                    ->orderBy('id','ASC')
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

    protected function generateSlug(array $data)
    {
        helper(['text','local']); // dùng url_title
        if (!isset($data['data']['name'])) return $data;

        $baseSlug = slugify($data['data']['name']);
        $slug = $baseSlug;
        $i = 1;

        // Tránh slug trùng nếu insert hoặc update
        while ($this->isSlugExists($slug, $data)) {
            $slug = $baseSlug . '-' . $i++;
        }

        $data['data']['slug'] = $slug;
        return $data;
    }

    protected function isSlugExists(string $slug, array $data): bool
    {
        $builder = $this->builder();
        $builder->where('slug', $slug);

        // Nếu là update thì loại trừ chính bản ghi đó
        if (!empty($data['id'])) {
            $builder->where($this->primaryKey . ' !=', $data['id']);
        }

        return $builder->countAllResults() > 0;
    }
}
