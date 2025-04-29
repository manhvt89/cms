<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $db;
    protected $table = 'tbl_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'logo', 'favicon', 'top_bar_email',
        'top_bar_phone', 'send_email_from', 'receive_email_to',
        'smtp_active','smtp_ssl','smtp_host',
        'smtp_port','smtp_username','smtp_password','banner_about','banner_testimonial',
        'banner_news','banner_event','banner_contact','banner_search','banner_verify_subscriber',
        'banner_privacy','banner_faq','banner_terms','banner_service','banner_portfolio','banner_team',
        'banner_pricing','banner_photo_gallery',
        'sidebar_total_recent_post','sidebar_total_upcoming_event','sidebar_total_past_event',
        'front_end_color','language_status','website_name','preloader_status',
        'tawk_live_chat_code','tawk_live_chat_status'
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

    /**
     * Lấy danh sách ngôn ngữ
     */
    public function _update($data)
	{
        return $this->table('tbl_settings')->where('id', 1)->set($data)->update();
    }
}
