<?php
// app/Models/ProductModel.php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'tbl_product';
    protected $primaryKey = 'product_id';

    protected $allowedFields = [
        'product_title', 'product_price', 'product_quantity', 'publication_status',
        'product_category', 'product_brand', 'product_image',
        // thêm các field khác nếu có
    ];

    public function getAllNewProduct()
    {
        return $this->select('
                tbl_product.*,
                tbl_category.category_name,
                tbl_brand.brand_name,
                tbl_product.publication_status as pstatus
            ')
            ->join('tbl_category', 'tbl_category.id = tbl_product.product_category')
            ->join('tbl_brand', 'tbl_brand.brand_id = tbl_product.product_brand')
            ->where('tbl_product.publication_status', 1)
            ->orderBy('tbl_product.product_id', 'DESC')
            ->limit(4)
            ->findAll();
    }
}
