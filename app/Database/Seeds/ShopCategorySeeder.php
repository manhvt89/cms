<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ShopCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'category_name' => 'Điện thoại',
                'category_description' => 'Các dòng smartphone mới nhất',
                'publication_status' => 1
            ],
            [
                'category_name' => 'Laptop',
                'category_description' => 'Máy tính xách tay hiện đại',
                'publication_status' => 1
            ],
            [
                'category_name' => 'Máy tính bảng',
                'category_description' => 'Tablet từ nhiều hãng khác nhau',
                'publication_status' => 1
            ],
            [
                'category_name' => 'Phụ kiện',
                'category_description' => 'Tai nghe, sạc, ốp lưng,...',
                'publication_status' => 1
            ],
            [
                'category_name' => 'Smartwatch',
                'category_description' => 'Đồng hồ thông minh các loại',
                'publication_status' => 1
            ],
            [
                'category_name' => 'Tivi',
                'category_description' => 'Tivi thông minh và màn hình lớn',
                'publication_status' => 1
            ],
            [
                'category_name' => 'Loa & Âm thanh',
                'category_description' => 'Loa Bluetooth, loa kéo,...',
                'publication_status' => 1
            ],
            [
                'category_name' => 'Máy ảnh',
                'category_description' => 'Máy ảnh kỹ thuật số và phụ kiện',
                'publication_status' => 1
            ],
            [
                'category_name' => 'Gaming Gear',
                'category_description' => 'Chuột, bàn phím, tai nghe game,...',
                'publication_status' => 1
            ],
            [
                'category_name' => 'Phần mềm',
                'category_description' => 'Bản quyền Windows, Office,...',
                'publication_status' => 1
            ],
        ];

        $this->db->table('tbl_shop_category')->insertBatch($data);
    }
}
