<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;
use App\Models\Admin\ShopProductModel;

class ProductUuidSeeder extends Seeder
{
    public function run()
    {
        $productModel = new ShopProductModel();

        $products = $productModel->findAll();

        foreach ($products as $product) {
            if (empty($product['product_uuid'])) {
                $productModel->update($product['product_id'], [
                    'product_uuid' => Uuid::uuid4()->toString(),
                ]);
            }
        }

        echo "Đã cập nhật product_uuid cho các sản phẩm.\n";
    }
}
