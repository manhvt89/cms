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
