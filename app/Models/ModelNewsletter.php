<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNewsletter extends Model
{
    protected $table = 'tbl_subscriber';
    protected $primaryKey = 'subs_id';
    protected $allowedFields = [
        'subs_email',
        'subs_date',
        'subs_date_time',
        'subs_hash',
        'subs_active',
    ];
    protected $useTimestamps = false;

    // Kiểm tra email đã tồn tại
    public function total_subscriber_by_email($email)
    {
        return $this->where('subs_email', $email)->countAllResults();
    }

    // Thêm mới subscriber
    public function add($data)
    {
        $this->insert($data);
        return $this->getInsertID();
    }

    // Kiểm tra URL xác thực
    public function check_url( $hash)
    {
        return $this->where('subs_hash', $hash)
                    ->countAllResults();
    }

    // Cập nhật subscriber sau khi xác thực
    public function update_by_hash($hash, $data)
    {
        return $this->where('subs_hash', $hash)
                    ->set($data)
                    ->update();
    }
}