<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function get_portfolio_category()
    {
        return $this->db
            ->table('tbl_portfolio_category')
            ->where('lang_id', $_SESSION['sess_lang_id'])
            ->orderBy('category_name', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function get_portfolio_data()
    {
        return $this->db
            ->table('tbl_portfolio')
            ->where('lang_id', $_SESSION['sess_lang_id'])
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function get_portfolio_data_order_by_name()
    {
        return $this->db
            ->table('tbl_portfolio')
            ->where('lang_id', $_SESSION['sess_lang_id'])
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function get_portfolio_detail($id)
    {
        return $this->db
            ->table('tbl_portfolio')
            ->where('id', $id)
            ->get()
            ->getRowArray();
    }

    public function get_portfolio_photo($id)
    {
        return $this->db
            ->table('tbl_portfolio_photo')
            ->where('portfolio_id', $id)
            ->get()
            ->getResultArray();
    }

    public function get_portfolio_photo_number($id)
    {
        return $this->db
            ->table('tbl_portfolio_photo')
            ->where('portfolio_id', $id)
            ->countAllResults();
    }

    public function portfolio_detail($id)
    {
        return $this->get_portfolio_detail($id);
    }

    public function check_captcha()
    {
        return $this->db
            ->table('tbl_setting_captcha')
            ->where('id', 1)
            ->get()
            ->getRowArray();
    }

    public function total_captcha()
    {
        return $this->db
            ->table('tbl_captcha')
            ->countAllResults();
    }

    public function get_particular_captcha($id)
    {
        return $this->db
            ->table('tbl_captcha')
            ->where('captcha_id', $id)
            ->get()
            ->getRowArray();
    }
}
