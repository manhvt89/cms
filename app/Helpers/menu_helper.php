<?php

use \App\Models\Admin\MenuModel;
use \App\Models\Admin\MenuGroupModel;
use Config\Permissions;

if (!function_exists('get_menu_html')) {
    function get_menu_html($group_slug, $options = [])
    {
        $menuGroupModel = new MenuGroupModel();
        $menuModel = new MenuModel();

        // Tìm group
        $group = $menuGroupModel->where('slug', $group_slug)->first();
        if (!$group) {
            return '';
        }

        // Lấy menu items
        $menus = $menuModel
            ->where('group_id', $group['id'])
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        if (empty($menus)) {
            return '';
        }

        $menu_tree = build_menu_tree($menus);

        // Merge default option
        $default_options = [
            'ul_class' => 'menu', // class cho <ul>
            'li_class' => 'menu-item', // class cho <li>
            'a_class'  => 'menu-link', // class cho <a>
            'active_class' => 'active' // class nếu đang là trang hiện tại
        ];
        $options = array_merge($default_options, $options);

        return render_menu($menu_tree, $options);
    }
}

if (!function_exists('build_menu_tree')) {
    function build_menu_tree(array $elements, $parentId = 0)
    {
        $branch = [];

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = build_menu_tree($elements, $element['menu_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
}

if (!function_exists('render_menu')) {
    function render_menu($menus, $options, $is_sub = false)
    {
        $ul_class = $is_sub ? 'submenu' : $options['ul_class'];
        $html = '<ul class="' . esc($ul_class) . '">';

        foreach ($menus as $menu) {
            if(empty($menu['url'])) continue; // clean item with url is null or blank
            $current_url = current_url();
            $menu_url = base_url($menu['url']??"");
            $active = ($current_url == $menu_url) ? $options['active_class'] : '';

            $html .= '<li class="' . esc($options['li_class']) . ' ' . $active . '">';
            $html .= '<a href="' . $menu_url . '" class="' . esc($options['a_class']) . '">' . esc($menu['title']) . '</a>';

            if (isset($menu['children'])) {
                $html .= render_menu($menu['children'], $options, true);
            }

            $html .= '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}
