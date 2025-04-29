<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTeam extends Model
{
    protected $table      = 'tbl_team_member';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;

    public function allTeamMember(int $langId): array
    {
        return $this->where('lang_id', $langId)
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }

    public function teamMemberExists(int $id): bool
    {
        return $this->where('id', $id)->countAllResults() > 0;
    }

    public function getTeamMemberDetail(int $id): ?array
    {
        return $this->find($id);
    }
}
