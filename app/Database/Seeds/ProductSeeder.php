<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $data = [];

        for ($i = 1; $i <= 25; $i++) {
            $data[] = [
                'product_title'             => 'Sản phẩm ' . $i,
                'product_short_description'=> $faker->sentence(6),
                'product_long_description' => $faker->paragraph(3),
                'product_image'            => 'product_' . $i . '.jpg',
                'product_price'            => rand(100, 1000) * 1000,
                'product_quantity'         => rand(1, 50),
                'product_feature'          => rand(0, 1),
                'product_category'         => rand(1, 5),
                'product_brand'            => rand(1, 5),
                'product_author'           => 1,
                'product_view'             => rand(0, 100),
                'published_date'           => date('Y-m-d H:i:s'),
                'publication_status'       => 1
            ];
        }

        $this->db->table('tbl_product')->insertBatch($data);
    }
}
