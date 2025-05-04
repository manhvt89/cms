<?php

if (!function_exists('transform_client_list')) {
    function transform_client_list(array $clients): array
    {
        $defaultPhoto = '/uploads/default-client.png'; // Ảnh mặc định nếu không có ảnh
        $result = [];

        foreach ($clients as $i => $row) {
            $item = [];

            // STT
            $item['no'] = $i + 1;

            // Ảnh
            $photoPath = !empty($row['photo']) ? $row['photo'] : $defaultPhoto;
            $item['photo'] = '<img src="' . base_url($photoPath) . '" alt="' . esc($row['name']) . '" title="' . esc($row['name']) . '" style="width:120px;">';

            // Tên + Badge
            $badges = '';
            if (!empty($row['is_hot'])) {
                $badges .= ' <span class="badge badge-danger">HOT</span>';
            }
            if (!empty($row['is_new'])) {
                $badges .= ' <span class="badge badge-success">NEW</span>';
            }
            $item['name'] = esc($row['name']) . $badges;

            // URL
            if (!empty($row['url'])) {
                $isExternal = (strpos($row['url'], 'http://') === 0 || strpos($row['url'], 'https://') === 0);
                $target = $isExternal ? ' target="_blank"' : '';
                $item['url'] = '<a href="' . esc($row['url']) . '"' . $target . '>' . esc($row['url']) . '</a>';
            } else {
                $item['url'] = '(Không có link)';
            }

            // Action
            // Full HTML nút Edit
            $editUrl = base_url("admin/client/edit/{$row['id']}");
            $item['edit_button'] = "<a href=\"{$editUrl}\" class=\"btn btn-primary btn-xs\">Edit</a>";

            // Full HTML nút Delete
            $deleteUrl = base_url("admin/client/delete/{$row['id']}");
            $button = <<<HTML
                        <a href="{$deleteUrl}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</a>
                        HTML;
            $item['delete_button'] = $button;


            $result[] = $item;
        }

        return $result;
    }
}

if (!function_exists('transform_the_news')) {
    function transform_the_news(array $news): array
    {
        $defaultPhoto = '/uploads/default-client.png'; // Ảnh mặc định nếu không có ảnh
        $result = [];

        $news['news_date'] = format_news_date($news['news_date']);

        // STT
        
        // Ảnh
        $photoPath = !empty($news['photo']) ? $news['photo'] : $defaultPhoto;
        $news['photo'] = '<img src="' . base_url($photoPath) . '" alt="' . esc($news['news_title']) . '" title="' . esc($news['news_title']) . '">';
        
        $_sSlugCat = slugify($news["category_name"]);

        // URL
        $news['cat'] = "";
        
        // Full HTML nút Delete
        $catUrl = base_url("category/{$_sSlugCat}-{$news['category_id']}");
        $button = <<<HTML
                    <a href="{$catUrl}" class="btn btn-danger btn-xs">{$news["category_name"]}</a>
                    HTML;
        $news['cat'] = $button;

        return $news;
    }
}

if (!function_exists('transform_shop_category')) {
    function transform_shop_category(array $items): array
    {
        $defaultPhoto = '/uploads/default-client.png'; // Ảnh mặc định nếu không có ảnh
        $result = [];
        $index = 1;
        foreach ($items as $i => $row) {
            $item = [];

            // STT
            $item['no'] = $index;
            $index++;

            // Ảnh
            $photoPath = !empty($row['category_photo']) ? $row['category_photo'] : $defaultPhoto;
            $item['category_photo'] = '<img src="' . base_url($photoPath) . '" alt="' . esc($row['category_name']) . '" title="' . esc($row['category_name']) . '" width="100px" >';

            // Tên
        
            $item['category_name'] = esc($row['category_name']);

            // Description
            $item['category_description'] = $row['category_description'];

            //publication_status
            $item["publication_status"] = $row["publication_status"] == 1 ? "<span class=\"label label-success\">Published</span>" : "<span class=\"label label-danger\" style=\"background:red\">Unpublished</span>";
            
            //slug
            $item['category_slug'] = esc($row['category_slug']);
            // Action
            // Full HTML nút Edit
            $editUrl = base_url("admin/shop/edit/category/{$row['id']}");
            $item['edit_button'] = "<a href=\"{$editUrl}\" class=\"btn btn-primary btn-xs\">Edit</a>";

            // Full HTML nút Delete
            $deleteUrl = base_url("admin/shop/delete/category/{$row['id']}");
            $button = <<<HTML
                        <a href="{$deleteUrl}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</a>
                        HTML;
            $item['delete_button'] = $button;

            $result[] = $item;
        }

        return $result;
    }
}



if (!function_exists('transform_shop_brand')) {
    function transform_shop_brand(array $items): array
    {
        $defaultPhoto = '/uploads/default-client.png'; // Ảnh mặc định nếu không có ảnh
        $result = [];
        $index = 1;
        foreach ($items as $i => $row) {
            $item = [];

            // STT
            $item['no'] = $index;
            $index++;

            // Ảnh
            $photoPath = !empty($row['brand_logo']) ? $row['brand_logo'] : $defaultPhoto;
            $item['brand_logo'] = '<img src="' . base_url($photoPath) . '" alt="' . esc($row['brand_name']) . '" title="' . esc($row['brand_name']) . '" width="100px" >';

            // Tên
        
            $item['brand_name'] = esc($row['brand_name']);

            // Description
            $item['brand_description'] = $row['brand_description'];

            //publication_status
            $item["publication_status"] = $row["publication_status"] == 1 ? "<span class=\"label label-success\">Published</span>" : "<span class=\"label label-danger\" style=\"background:red\">Unpublished</span>";
            
            //slug
            $item['brand_slug'] = esc($row['brand_slug']);
            $item['brand_keyword'] = esc($row['brand_keyword']);
            // Action
            // Full HTML nút Edit
            $editUrl = base_url("admin/shop/edit/brand/{$row['brand_id']}");
            $item['edit_button'] = "<a href=\"{$editUrl}\" class=\"btn btn-primary btn-xs\">Edit</a>";

            // Full HTML nút Delete
            $deleteUrl = base_url("admin/shop/delete/brand/{$row['brand_id']}");
            $button = <<<HTML
                        <a href="{$deleteUrl}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</a>
                        HTML;
            $item['delete_button'] = $button;

            $result[] = $item;
        }

        return $result;
    }
}

if (!function_exists('transform_shop_product')) {
    function transform_shop_product(array $items): array
    {
        $defaultPhoto = '/uploads/default-client.png'; // Ảnh mặc định nếu không có ảnh
        $result = [];
        $index = 1;
        foreach ($items as $i => $row) {
            $item = [];

            // STT
            $item['no'] = $index;
            $index++;

            // Ảnh
            $photoPath = !empty($row['product_image']) ? $row['product_image'] : $defaultPhoto;
            $item['product_image'] = '<img src="' . base_url($photoPath) . '" alt="' . esc($row['product_title']) . '" title="' . esc($row['product_title']) . '" width="100px" >';

            // Tên
        
            $item['product_title'] = esc($row['product_title']);

            // Description
            $item['product_short_description'] = $row['product_short_description'];
            $item['product_long_description'] = $row['product_long_description'];

            //publication_status
            $item["publication_status"] = $row["publication_status"] == 1 ? "<span class=\"label label-success\">Published</span>" : "<span class=\"label label-danger\" style=\"background:red\">Unpublished</span>";
            
            //slug
            $item['product_slug'] = esc($row['product_slug']);
            $item['product_keyword'] = esc($row['product_keyword']);
            // Action
            // Full HTML nút Edit
            $editUrl = base_url("admin/shop/edit/product/{$row['product_id']}");
            $item['edit_button'] = "<a href=\"{$editUrl}\" class=\"btn btn-primary btn-xs\">Edit</a>";

            // Full HTML nút Delete
            $deleteUrl = base_url("admin/shop/delete/product/{$row['product_id']}");
            $button = <<<HTML
                        <a href="{$deleteUrl}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</a>
                        HTML;
            $item['delete_button'] = $button;

            $result[] = $item;
        }

        return $result;
    }
}
