<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ModelProfile extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'photo', 'password'];

    public function update_profile($data)
    {
        return $this->update(1, $data);
    }
}
