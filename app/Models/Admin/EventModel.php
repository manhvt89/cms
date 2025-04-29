<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $db;
    protected $table = 'tbl_event';
    protected $primaryKey = 'event_id';
    protected $allowedFields = [
        'event_title','event_content','event_content_short','event_start_date','event_end_date',
        'event_location','event_map','photo','banner','lang_id','meta_title',
        'meta_keyword','meta_description'
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
        
        $builder = $this->db->table($this->table . ' t1');
        $builder->select('*');
        $builder->join('tbl_lang t2', 't1.lang_id = t2.lang_id');
        $builder->orderBy('t1.event_id', 'DESC');
        return $builder->get()->getResultArray();
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
        return $this->where('event_id', $id)->set($data)->update();
    }

    // ✅ Hàm: delete
    public function _delete($id)
    {
        return $this->where('event_id', $id)->delete();
    }

    // ✅ Hàm: getData
    public function getData($id)
    {
        return $this->where('event_id', $id)->first();
    }

    // ✅ Hàm: event_check
    public function event_check($id)
    {
        return $this->getData($id);
    }
}
