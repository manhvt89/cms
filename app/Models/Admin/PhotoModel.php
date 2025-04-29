<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PhotoModel extends Model
{
    protected $db;
    protected $table = 'tbl_photo';
    protected $primaryKey = 'photo_id';
    protected $allowedFields = [
        'photo_name'
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
        return $this->db->table($this->table)
                        ->orderBy('photo_id', 'DESC')
                        ->get()->getResultArray();
    }

    // ✅ Hàm: add
    public function add($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    // ✅ Hàm: update
    public function _update($id, $data)
    {
        return $this->where('photo_id', $id)->set($data)->update();
    }

    // ✅ Hàm: delete
    public function _delete($id)
    {
        return $this->where('photo_id', $id)->delete();
    }

    // ✅ Hàm: getData
    public function getData($id)
    {
        return $this->where('photo_id', $id)->first();
    }

    // ✅ Hàm: event_check
    public function event_check($id)
    {
        return $this->getData($id);
    }
}
