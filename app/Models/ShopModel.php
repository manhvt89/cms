<?php

namespace App\Models;

use CodeIgniter\Model;

class ShopModel extends Model
{
    protected $db;
    protected $table            = 'tbl_product';
    protected $primaryKey       = 'product_id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function get_all_featured_product($limit = 4)
    {
        return $this->select('
                tbl_product.*,
                tbl_shop_category.category_name,
                tbl_brand.brand_name,
                tbl_product.publication_status as pstatus
            ')
            ->join('tbl_shop_category', 'tbl_shop_category.id = tbl_product.product_category')
            ->join('tbl_brand', 'tbl_brand.brand_id = tbl_product.product_brand')
            ->where('tbl_product.publication_status', 1)
            ->where('product_feature', 1)
            ->orderBy('tbl_product.product_id', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function get_all_new_product($limit = 4)
    {
        return $this->select('
                tbl_product.*,
                tbl_shop_category.category_name,
                tbl_brand.brand_name,
                tbl_product.publication_status as pstatus
            ')
            ->join('tbl_shop_category', 'tbl_shop_category.id = tbl_product.product_category')
            ->join('tbl_brand', 'tbl_brand.brand_id = tbl_product.product_brand')
            ->where('tbl_product.publication_status', 1)
            ->orderBy('tbl_product.product_id', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function get_all_product()
    {
        return $this->db->table('tbl_product p')
                    ->select('p.*, tbl_shop_category.*, tbl_brand.*, p.publication_status as pstatus')
                    
                    ->join('tbl_shop_category c', 'c.id=p.product_category')
                    ->join('tbl_brand b', 'b.brand_id=p.product_brand')
                    ->orderBy('p.product_id', 'DESC')
                    ->where('p.publication_status', 1)
                    ->get()
                    ->getResultArray();
        
    }

    public function get_all_product_pagi($limit,$offset)
    {
        return $this->db->table('tbl_product p')
                    ->select('p.*, c.*, b.*, p.publication_status as pstatus')
                    
                    ->join('tbl_shop_category c', 'c.id=p.product_category')
                    ->join('tbl_brand b', 'b.brand_id=p.product_brand')
                    ->orderBy('p.product_id', 'DESC')
                    ->where('p.publication_status', 1)
                    ->limit($limit,$offset)
                    ->get()
                    ->getResultArray();
    }

    public function get_single_product($id)
    {
        return $this->db->table('tbl_product')
                    ->select('tbl_product.*, tbl_shop_category.*, tbl_brand.*, tbl_product.publication_status as pstatus')
                    ->join('tbl_shop_category', 'tbl_shop_category.id = tbl_product.product_category', 'left')
                    ->join('tbl_brand', 'tbl_brand.brand_id = tbl_product.product_brand', 'left')
                    ->where('tbl_product.product_id', $id)
                    ->get()
                    ->getRowArray(); // getRowObject() nếu muốn trả về đối tượng
    }

    public function get_all_category()
    {
        return $this->db->table('tbl_shop_category')
                    ->where('publication_status', 1)
                    ->get()
                    ->getResultArray();
    }

    public function get_all_product_by_cat($id)
    {
        return $this->db->table('tbl_product p')
                    ->select('*')
                    ->join('tbl_shop_category c', 'c.id=p.product_category')
                    ->join('tbl_brand b', 'b.brand_id=p.product_brand')
                    ->orderBy('p.product_id', 'DESC')
                    ->where('p.publication_status', 1)
                    ->where('c.id', $id)
                    ->get()
                    ->getResultArray();
    }

    public function get_product_by_id($id)
    {
        
        return $this->db->table('tbl_product p')
                    ->join('tbl_shop_category c', 'c.id=p.product_category')
                    ->join('tbl_brand b', 'b.brand_id=c.product_brand')
                    ->orderBy('p.product_id', 'DESC')
                    ->where('p.publication_status', 1)
                    ->where('p.product_id', $id)
                    ->get()
                    ->getRow();
    }

    public function save_customer_info($data)
    {
        return $this->db->table('tbl_customer')->insert($data) ? $this->db->insertID() : false;
    }

    public function save_shipping_address($data)
    {
        return $this->db->table('tbl_shipping')->insert($data) ? $this->db->insertID() : false;
    }

    public function get_customer_info($data)
    {
        return $this->db->table('tbl_customer')
                    ->where($data)
                    ->get()
                    ->getRow();
    }

    public function save_payment_info($data)
    {
        return $this->db->table('tbl_payment')->insert($data) ? $this->db->insertID() : false;
    }

    public function save_order_info($data)
    {
        return $this->db->table('tbl_order')->insert($data) ? $this->db->insertID() : false;
    }

    public function save_order_details_info($oddata)
    {
        return $this->db->table('tbl_order_details')->insert($data) ? $this->db->insertID() : false;
    }

    public function get_all_popular_posts()
    {
        
        return $this->db->table('tbl_product')
                    ->where('publication_status', 1)
                    ->limit(4)
                    ->get()
                    ->getResultArray();
    }

    public function get_all_search_product($search)
    {
        
        return $this->db->table('tbl_product')
                    ->join('tbl_shop_category', 'tbl_shop_category.id=tbl_product.product_category')
                    ->join('tbl_brand', 'tbl_brand.brand_id=tbl_product.product_brand')
                    ->join('tbl_user', 'tbl_user.user_id=tbl_product.product_author')
                    ->orderBy('tbl_product.product_id', 'DESC')
                    ->where('tbl_product.publication_status', 1)
                    ->like('tbl_product.product_title', $search, 'both')
                    ->orLike('tbl_product.product_short_description', $search, 'both')
                    ->orLike('tbl_product.product_long_description', $search, 'both')
                    ->orLike('tbl_shop_category.category_name', $search, 'both')
                    ->orLike('tbl_brand.brand_name', $search, 'both')
                    ->get()
                    ->getResultArray();
    }

    public function get_total_product()
    {
        return $this->where('publication_status', 1)->countAllResults();
    }

    public function item_check($id)
    {
        return $this->get_single_product($id);
    }
}