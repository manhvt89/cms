<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelService extends Model
{
    protected $table = 'tbl_service';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;

    public function all_service(int $langId): array
    {
        return $this->where('lang_id', $langId)
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }

    public function service_exists(int $id): bool
    {
        return $this->where('id', $id)->countAllResults() > 0;
    }

    public function get_service_detail(int $id): ?array
    {
        return $this->find($id);
    }

    public function check_captcha(): ?array
    {
        return $this->db->table('tbl_setting_captcha')
                        ->where('id', 1)
                        ->get()
                        ->getRowArray();
    }

    public function total_captcha(): int
    {
        return $this->db->table('tbl_captcha')->countAllResults();
    }

    public function get_particular_captcha(int $id): ?array
    {
        return $this->db->table('tbl_captcha')
                        ->where('captcha_id', $id)
                        ->get()
                        ->getRowArray();
    }
}
