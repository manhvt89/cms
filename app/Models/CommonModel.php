<?php

namespace App\Models;

use CodeIgniter\Model;

class CommonModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function all_setting()
    {
        return $this->db->table('tbl_settings')->where('id', 1)->get()->getRowArray();
    }

    public function all_page_home($langId = 5)
    {
        return $this->db->table('tbl_page_home')
                        ->where('lang_id', $langId)
                        ->get()
                        ->getRowArray();
        
    }

    public function all_comment()
    {
        return $this->db->table('tbl_comment')->get()->getResultArray();
    }

    public function all_social()
    {
        return $this->db->table('tbl_social')->get()->getResultArray();
    }

    public function all_news()
    {
        return $this->db->table('tbl_news')->get()->getResultArray();
    }

    public function get_page_faq()
    {
        return $this->db->table('tbl_page')->where('id', 1)->get()->getRowArray();
    }

    public function get_faq()
    {
        return $this->db->table('tbl_faq')->orderBy('faq_id', 'asc')->get()->getResultArray();
    }

    public function get_news($limit)
    {
        return $this->db->table('tbl_news')
            ->orderBy('news_id', 'desc')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    public function get_total_service()
    {
        return $this->db->table('tbl_service')->countAllResults();
    }

    public function get_total_portfolio()
    {
        return $this->db->table('tbl_portfolio')->countAllResults();
    }

    public function get_total_team_member()
    {
        return $this->db->table('tbl_team_member')->countAllResults();
    }

    public function get_total_testimonial()
    {
        return $this->db->table('tbl_testimonial')->countAllResults();
    }

    public function all_page_home_lang_independent()
    {
        return $this->db->table('tbl_page_home_lang_independent')->where('id', 1)->get()->getRowArray();
    }
    public function all_footer_setting($langId=5)
    {
        return $this->db->table('tbl_footer')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_footer_setting_lang_independent()
    {
        return $this->db->table('tbl_footer_lang_independent')->where('id', 1)->get()->getRowArray();
    }

    public function all_page_about($langId = 5)
    {
        return $this->db->table('tbl_page_about')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_faq($langId = 5)
    {
        return $this->db->table('tbl_page_faq')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_service($langId = 5)
    {
        return $this->db->table('tbl_page_service')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_testimonial($langId = 5)
    {
        return $this->db->table('tbl_page_service')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_news($langId = 5)
    {
        return $this->db->table('tbl_page_news')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_event($langId = 5)
    {
        return $this->db->table('tbl_page_event')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_contact($langId = 5)
    {
        return $this->db->table('tbl_page_contact')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_search($langId = 5)
    {
        return $this->db->table('tbl_page_search')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_term($langId = 5)
    {
        return $this->db->table('tbl_page_term')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_privacy($langId = 5)
    {        
        return $this->db->table('tbl_page_privacy')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_pricing($langId = 5)
    {
        return $this->db->table('tbl_page_pricing')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_photo_gallery($langId = 5)
    {
        return $this->db->table('tbl_page_photo_gallery')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_team($langId = 5)
    {
        return $this->db->table('tbl_page_team')->where('lang_id', $langId)->get()->getRowArray();
    }
    public function all_page_portfolio($langId = 5)
    {
        return $this->db->table('tbl_page_portfolio')->where('lang_id', $langId)->get()->getRowArray();
    }
   
    public function all_news_category($langId = 5)
    {
        return $this->db->table('tbl_news t1')
                    ->select('*')
                    ->join('tbl_category t2', 't1.category_id = t2.category_id')
                    ->where('t1.lang_id', $langId)
                    ->orderBy('t1.news_id', 'DESC')
                    ->get()
                    ->getResultArray();
    }
    public function all_event()
    {
        return $this->db->table('tbl_event')
                    ->orderBy('event_id', 'DESC')
                    ->get()
                    ->getResultArray();
    }
    public function all_categories($langId = 5)
    {
        return $this->db->table('tbl_category')
                    ->where('lang_id', $langId)
                    ->orderBy('category_name', 'ASC')
                    ->get()
                    ->getResultArray();
    }
    public function extension_check_photo($ext) {
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' && $ext!='JPG' && $ext!='PNG' && $ext!='JPEG' && $ext!='GIF' ) {
            return false;
        } else {
            return true;
        }
    }

    public function all_dynamic_pages($langId = 5)
    {
        return $this->db->table('tbl_page_dynamic')
                    ->where('lang_id', $langId)
                    ->get()
                    ->getResultArray();
    }

}
