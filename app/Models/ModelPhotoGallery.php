<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPhotoGallery extends Model
{
    protected $db;
    protected $table            = 'tbl_photo';
    protected $primaryKey       = 'photo_id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    public function all_photo()
    {
        return $this->db->table('tbl_photo')
            ->orderBy('photo_id', 'ASC')
            ->get()
            ->getResultArray();
    }



}