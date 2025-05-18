<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySlugSeeder extends Seeder
{
    public function run()
    {
        helper(['local']);

        $db = \Config\Database::connect();
        $builder = $db->table('tbl_category');
        $query = $builder->get();

        foreach ($query->getResult() as $row) {
            $slug = slugify($row->category_name);
            $builder->where('category_id', $row->category_id)->update(['category_slug' => $slug]);
        }
    }
}
