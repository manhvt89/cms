<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ModelLogin extends Model
{
    protected $table      = 'tbl_user';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;

    /**
     * Lấy thông tin cài đặt hệ thống
     */
    public function get_setting_data(): ?array
    {
        return $this->db->table('tbl_settings')
                        ->where('id', 1)
                        ->get()
                        ->getRowArray();
    }

    /**
     * Kiểm tra email có tồn tại không
     */
    public function check_email(string $email): ?array
    {
        return $this->db->table($this->table)
                        ->where('email', $email)
                        ->get()
                        ->getRowArray();
    }

    /**
     * Kiểm tra đúng mật khẩu không (md5, giữ nguyên logic cũ)
     */
    public function check_password(string $email, string $password): ?array
    {
        return $this->db->table($this->table)
                        ->where([
                            'email'    => $email,
                            'password' => md5($password),
                        ])
                        ->get()
                        ->getRowArray();
    }
}
