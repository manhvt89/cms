<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UpdateNewsSlugSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_news');

        $newsList = $builder->where('slug', null)->get()->getResult();

        helper('local'); // dùng slugify()

        foreach ($newsList as $news) {
            $slug = slugify($news->news_title);

            // Nếu slug đã tồn tại, thêm id vào cuối cho duy nhất
            $exists = $builder->where('slug', $slug)->countAllResults();
            if ($exists > 0) {
                $slug .= '-' . $news->news_id;
            }

            $builder->where('news_id', $news->news_id)
                    ->update(['slug' => $slug]);
        }

        echo count($newsList) . " bài viết đã được cập nhật slug.\n";
    }
}
