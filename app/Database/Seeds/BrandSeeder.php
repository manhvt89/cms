<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'brand_name' => 'Apple',
                'brand_description' => 'Thương hiệu nổi tiếng với iPhone, MacBook, và iPad.',
                'publication_status' => 1
            ],
            [
                'brand_name' => 'Samsung',
                'brand_description' => 'Hãng điện tử Hàn Quốc chuyên điện thoại, TV, thiết bị gia dụng.',
                'publication_status' => 1
            ],
            [
                'brand_name' => 'Sony',
                'brand_description' => 'Nổi tiếng với tivi, âm thanh và PlayStation.',
                'publication_status' => 1
            ],
            [
                'brand_name' => 'Xiaomi',
                'brand_description' => 'Thương hiệu Trung Quốc giá rẻ, cấu hình tốt.',
                'publication_status' => 1
            ],
            [
                'brand_name' => 'Dell',
                'brand_description' => 'Chuyên về laptop và máy tính doanh nghiệp.',
                'publication_status' => 1
            ],
        ];

        // Chèn nhiều dòng một lúc
        $this->db->table('tbl_brand')->insertBatch($data);
    }
}
