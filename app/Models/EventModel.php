<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $db;
    protected $table            = 'tbl_event';
    protected $primaryKey       = 'event_id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    public function all_event($langId = 5)
    {
        return $this->db->table($this->table)
                        ->where('lang_id',$langId)
                        ->orderBy('event_id','DESC')
                        ->get()
                        ->getResultArray();
    }

    public function event_check($id)
    {
        return $this->db->table($this->table)
                        ->where('event_id',$id)
                        ->get()
                        ->getNumRows();
    }

    public function event_detail($id)
    {
        return $this->db->table($this->table)
                        ->where('event_id',$id)
                        ->get()
                        ->getRowArray();
    }

    public function get_total_event() {
        return $this->db->table('tbl_event')->countAllResults();
    }

    public function fetch_event($limit, $offset = 0, $langId = 5) {
        if ($langId === null && session()->has('sess_lang_id')) {
            $langId = session('sess_lang_id');
        }
    
        $builder = $this->db->table('tbl_event')
            ->where('lang_id', $langId)
            ->orderBy('event_id', 'desc')
            ->limit($limit, $offset);
    
        $query = $builder->get();
        return $query->getResultObject(); // hoặc getResultArray() nếu bạn muốn array
    }

}