<?php

use Config\Permissions;

if (!function_exists('get_user_role')) {
    function get_user_role(): string
    {
        // Lấy role từ session hoặc service đăng nhập
        return session()->get('role') ?? 'Editor';
    }
}

if (!function_exists('has_permission_with_key')) {
    function has_permission_with_key(string $key): bool
    {
        $permissions = config(Permissions::class)->rolePermissions;
        $role = get_user_role();
        return in_array($key, $permissions[$role] ?? []);
    }
}

if (!function_exists('render_admin_menu')) {
    /**
     * Hiển thị menu sidebar theo phân quyền
     */
    function render_admin_menu(): string
    {
        $config = config(Permissions::class);
        $menu = $config->menu;

        // Sắp xếp cấp cha
        uasort($menu, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

        $html = '';

        foreach ($menu as $key => $item) {
            if (!has_permission_with_key($key) || ($item['value'] == "" && $item['items'] == [])) {
                continue;
            }

            $iconHtml = '';
            //$label = $item['label'] ? trim($item['label']) : ucwords(str_replace(['_', '.index'], [' ', ''], $key));
            $label = trim($item['label'] ?? '') ?: ucwords(str_replace(['_', '.index'], [' ', ''], $key));

            if (!empty($item['icon_image'])) {
                $iconHtml = '<img src="' . base_url($item['icon_image']) . '" alt="' . $label . '" style="width: 18px; height: 18px;">';
            } elseif (!empty($item['icon_class'])) {
                $iconHtml = '<i class="' . esc($item['icon_class']) . '"></i>';
            }


            $hasChildren = !empty($item['items']);
            
            $url = get_menu_url($item);
            
            
            $tooltip = trim($item['tooltip'] ?? '');
           
            $activeClass = $hasChildren ? 'treeview' : '';

            $html .= '<li class="' . $activeClass . '">';
            $html .= '<a href="' . $url . '" title="' . $tooltip . '">';
            $html .=  $iconHtml ;
            
            $html .= '<span>' . $label .'</span>';

            if ($hasChildren) {
                $html .= '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>';
            }

            $html .= '</a>';

            if ($hasChildren) {
                $html .= '<ul class="treeview-menu">';
                $children = $item['items'];
                //var_dump($children);
                uasort($children, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

                foreach ($children as $subKey => $subItem) {
                    if (!has_permission_with_key($subKey)) continue;
                    $subLabel = trim($subItem['label'] ?? '') ?: ucwords(str_replace(['_', '.index'], [' ', ''], $subKey));
                    $subiconHtml = '';
                    if (!empty($subItem['icon_image'])) {
                        $subiconHtml = '<img src="' . base_url($subItem['icon_image']) . '" alt="' . $subLabel . '" style="width: 18px; height: 18px;">';
                    } elseif (!empty($subItem['icon_class'])) {
                        $subiconHtml = '<i class="' . esc($subItem['icon_class']) . '"></i>';
                    }
                    $subUrl = get_menu_url($subItem);
                    //$subLabel = ucwords(str_replace(['_', '.index'], [' ', ''], $subKey));

                    $html .= '<li class="">';
                    $html .= '<a href="' . $subUrl . '" class="">';
                    $html .= $subiconHtml;
                    $html .= '<span>' . $subLabel . '</span>';
                    $html .= '</a></li>';
                }

                $html .= '</ul>';
            }

            $html .= '</li>';
        }

        return $html;
    }
}

if (!function_exists('get_menu_url')) {
    function get_menu_url(array $item): string
    {
        // Lấy giá trị từ key 'value', nếu không tồn tại thì gán rỗng
        $value = $item['value'] ?? '';

        // Nếu rỗng thì trả về dấu # dùng cho href
        if (trim($value) === '') {
            return '#';
        }

        // Nếu không bắt đầu bằng 'admin/' thì thêm vào đầu
        if (strpos($value, 'admin/') !== 0) {
            $value = 'admin/' . ltrim($value, '/');
        }

        // Trả về URL hợp lệ
        return base_url($value);
    }
}
