<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTeamMember extends Model
{
    protected $table      = 'tbl_team_member';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;

    /**
     * Lấy toàn bộ danh sách thành viên team
     */
    public function getAll(): array
    {
        return $this->orderBy('id', 'ASC')->findAll();
    }

    /**
     * Kiểm tra sự tồn tại của 1 thành viên
     */
    public function exists(int $id): bool
    {
        return $this->where('id', $id)->countAllResults() > 0;
    }

    /**
     * Lấy thông tin chi tiết 1 thành viên
     */
    public function getDetail(int $id): ?array
    {
        return $this->find($id);
    }
}
