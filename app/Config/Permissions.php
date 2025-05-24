<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Permissions extends BaseConfig
{
    /**
     * 
     *  Item_menu = {
     * order: thứ tự item
     * value: link của item, nếu bằng null thì có menu con lúc này
     * items: là các mảng mneu con
     * 
     * }
     * @var array
     */
    public array $menu = [
        'shop.index' =>[
            'order'=>1,
            'icon_class' => 'fa fa-dashboard',
            'value'=>'',
            'items'=>[],
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
            'label'=>'SHOP',
        ],
        'page_section.index' =>[
            'order'=>6,
            'icon_class' => 'fa fa-newspaper-o',
            'value'=>'',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[
                'pagehome.index'=>[
                    'order'=>1,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pagehome',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                    'label'=>'Home Page',
                ],
                'pageabout.index'=>[
                    'order'=>2,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pageabout',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'About Page',
                ],
                'pagefaq.index'=>[
                    'order'=>3,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pagefaq',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'FAQ Page',
                ],
                'pageservice.index'=>[
                    'order'=>4,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pageservice',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'Service Page',
                ],
                'pagetestimonial.index'=>[
                    'order'=>5,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pagetestimonial',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'Testimonial Page',
                ],
                'pagenews.index'=>[
                    'order'=>1,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pagenews',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'News Page',
                ],
                'pageevent.index'=>[
                    'order'=>5,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pageevent',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'Event Page',
                ],
                'pagecontact.index'=>[
                    'order'=>4,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pagecontact',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'Contact Page',
                ],
                'pagesearch.index'=>[
                    'order'=>4,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pagesearch',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'Search Page',
                ],
                'pageteam.index'=>[
                    'order'=>4,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pageteam',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'Team Page',
                ],
                'pageportfolio.index'=>[
                    'order'=>4,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pageportfolio',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'Portfolio Page',
                ],
                'pagephoto-gallery.index'=>[
                    'order'=>4,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pagephoto-gallery',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'Gallery Page',
                ],
                'pagepricing.index'=>[
                    'order'=>4,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pagepricing',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'Pricing Page',
                ],
                'pageterm.index'=>[
                    'order'=>4,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pageterm',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'Term Page',
                ],
                'pageprivacy.index'=>[
                    'order'=>4,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'pageprivacy',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                     'label'=>'Privacy Page',
                ],
            ] 
        ],
        'category.index' =>[
            'order'=>3,
            'icon_class' => 'fa fa-folder-open',
            'value'=>'admin/category',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'news.index' =>[
            'order'=>2,
            'icon_class' => 'fa fa-newspaper-o',
            'value'=>'admin/news',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'event.index' =>[
            'order'=>5,
            'icon_class' => 'fa fa-calendar',
            'value'=>'admin/event',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'photo_gallery.index' =>[
            'order'=>6,
            'icon_class' => 'fa fa-image',
            'value'=>'admin/photo_gallery',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'portfolio.index' =>[
            'order'=>7,
            
            'value'=>'admin/portfolio',
            'icon_class' => 'fa fa-briefcase',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'footersetting.index' =>[
            'order'=>8,
            'value'=>'admin/footersetting',
            'icon_class' => 'fa fa-cog',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'menugroup.index' =>[
            'order'=>9,
            'value'=>'admin/menugroup',
            'icon_class' => 'fa fa-file-text',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'lang.index' =>[
            'order'=>10,
            'value'=>'admin/lang',
            'icon_class' => 'fa fa-language',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'slider.index' =>[
            'order'=>11,
            'value'=>'admin/slider',
            'icon_class' => 'fa fa-picture-o',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'service.index' =>[
            'order'=>11,
            'value'=>'admin/service',
            'icon_class' => 'fa fa-cogs',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'Services',
            'items'=>[]
        ],
        'team.index' =>[
            'order'=>12,
            'value'=>'admin/team',
            'icon_class' => 'fa fa-users',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'testimonial.index' =>[
            'order'=>13,
            'value'=>'admin/testimonial',
            'icon_class' => 'fa fa-comments',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'client.index' =>[
            'order'=>14,
            'value'=>'admin/client',
            'icon_class' => 'fa fa-handshake-o',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'pricing.index' =>[
            'order'=>15,
            'value'=>'admin/pricing',
            'icon_class' => 'fa fa-money',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'subscriber.index' =>[
            'order'=>16,
            'value'=>'admin/subscriber',
            'icon_class' => 'fa fa-envelope',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        /*
        'search.index' =>[
            'order'=>1,
            'value'=>'admin/search',
            'items'=>[]
        ],
        */
        'setting.index' =>[
            'order'=>17,
            'value'=>'admin/setting',
            'icon_class' => 'fa fa-cogs',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'whychoose.index' =>[
            'order'=>18,
            'value'=>'admin/whychoose',
            'icon_class' => 'fa fa-cogs',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'user.index' =>[
            'order'=>18,
            'value'=>'admin/user',
            'icon_class' => 'fa fa-users',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'dashboard.index' =>[
            'order'=>0,
            'value'=>'admin/dashboard',
            'icon_class' => 'fa fa-dashboard',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
    ];
    /**
     * Danh sách quyền được gán cho từng vai trò.
     */
    public array $rolePermissions = [
        'Admin' => [
            'shop.index',
            'page_section.index',
            'pagehome.index',
            'pagefaq.index',
            'pageabout.index',
            'pageservice.index',
            'pagetestimonial.index',
            'pagenews.index',
            'pageevent.index',
            'pagecontact.index',
            'pagesearch.index',
            'pageteam.index',
            'pageportfolio.index',
            'pagephoto-gallery.index',
            'pagepricing.index',
            'pageterm.index',
            'pageprivacy.index',
                    
            'category.index',
            'news.index',
            'event.index',
            'photo.index',
            'portfolio.index',
            'footersetting.index',
            'menugroup.index',
            'lang.index',
            'slider.index',
            'team.index',
            'testimonial.index',
            'client.index',
            'pricing.index',
            /*'subscriber.index',*/
            'search.index',
            'setting.index',
            'whychoose.index',
            'dashboard.index',
            'user.index',
            'user.create',
            'user.edit',
            'user.delete',
            'post.create',
            'post.edit',
            'post.delete',
            'settings.manage',
        ],
        'Manager' => [
            'dashboard.index',
            'user.edit',
            'post.create',
            'post.edit',
        ],
        'Editor' => [
            'dashboard.index',
            'post.create',
            'post.edit',
        ]
    ];
}
