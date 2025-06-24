<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\Admin\ServiceModel;

class InitServiceSlug extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'init:service-slug';
    protected $description = 'Khởi tạo slug cho dữ liệu đã có trong tbl_service';

    public function run(array $params)
    {
        helper('text'); // dùng url_title

        $model = new ServiceModel();
        $all   = $model->findAll();
        $count = 0;

        foreach ($all as $item) {
            if (!empty($item['slug'])) continue;

            $baseSlug = url_title($item['name'], '-', true);
            $slug     = $baseSlug;
            $i        = 1;

            // Kiểm tra slug tồn tại
            while ($model->where('slug', $slug)->where('id !=', $item['id'])->countAllResults() > 0) {
                $slug = $baseSlug . '-' . $i++;
            }

            $model->update($item['id'], ['slug' => $slug]);
            CLI::write("✅ Cập nhật ID {$item['id']} => {$slug}");
            $count++;
        }

        CLI::write("🎉 Hoàn tất. Đã cập nhật {$count} bản ghi.");
    }
}
