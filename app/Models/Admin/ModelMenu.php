<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ModelMenu extends Model
{
    protected $table      = 'tbl_menu';
    protected $primaryKey = 'menu_id';

    protected $allowedFields = ['menu_name', 'menu_status']; // cập nhật đúng theo cột bạn cần cập nhật

    public function show()
    {
        return $this->findAll();
    }

    public function updateMenu($menu_id, $data)
    {
        return $this->update($menu_id, $data);
    }
}
