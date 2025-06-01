<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Permissions extends BaseConfig
{
    /**
     * Liệt kê danh sách các hàm bỏ qua phân quyền.
     * Ví dụ hàm gọi ajax để lấy dữ liệu điền vào table, khi có quyền view table là có quyền load.ajax
     * @var array
     */
    public array $skipMethods = [
        'function1',
        'fun2'
    ];

    public $skipControllers = [
        'media', // controller
    ];
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
            'parent'=>'',
            'items'=>[
                'shopdashboard.index'=>[
                    'order'=>1,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'shop/dashboard',
                    'parent'=>'shop.index',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                    'label'=>'Shop Dashboard',
                ],
                'shopcategory.add'=>[
                    'order'=>1,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'shop/add/category',
                    'parent'=>'shop.index',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                    'label'=>'Shop Category',
                ],
                'shopcategory.index'=>[
                    'order'=>1,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'shop/manage/category',
                    'parent'=>'shop.index',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                    'label'=>'Shop Category Manage',
                ],
                'shopbrand.add'=>[
                    'order'=>1,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'shop/add/brand',
                    'parent'=>'shop.index',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                    'label'=>'Shop Brand Add',
                ],
                'shopbrand.index'=>[
                    'order'=>1,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'shop/manage/brand',
                    'parent'=>'shop.index',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                    'label'=>'Shop Brand',
                ],
                'shopproduct.add'=>[
                    'order'=>1,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'shop/add/product',
                    'parent'=>'shop.index',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                    'label'=>'Product Add',
                ],
                'shopproduct.index'=>[
                    'order'=>1,
                    'icon_class' => 'fa fa-circle-o',
                    'value'=>'shop/manage/product',
                    'parent'=>'shop.index',
                    'items'=>[],
                    'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
                    'target'     => '_self',                       // Mở tab mới nếu là _blank
                    'tooltip'    => '',                            // Tooltip gợi ý khi hover
                    'badge'      => '',
                    'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
                    'label'=>'Product List',
                ],
            ],
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
            'parent'=>'',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
                    'parent'=>'page_section.index',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
            'icon_class' => 'fa fa-file-text',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],
        'feature.index' =>[
            'order'=>5,
            'icon_class' => 'fa fa-fire',
            'value'=>'admin/feature',
            'parent'=>'',
            'permission' => 'feature.index',                // Key permission (nếu khác key chính)
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
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
            'parent'=>'',
            'icon_class' => 'fa fa-dashboard',
            'permission' => 'shop.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
             'label'=>'',
            'items'=>[]
        ],

        'tools.index' =>[
            'order'=>99,
            'value'=>'clear-cache',
            'parent'=>'',
            'icon_class' => 'fa fa-dashboard',
            'permission' => 'tools.index',                  // Key permission (nếu khác key chính)
            'target'     => '_self',                       // Mở tab mới nếu là _blank
            'tooltip'    => '',                            // Tooltip gợi ý khi hover
            'badge'      => '',
            'icon_image' => '', // ✅ đường dẫn ảnh nếu dùng hình /assets/icons/dashboard.png
            'label'=>'Clear Cache',
            'ajax' => true, // thêm dòng này để biết nó cần gọi AJAX
            'data_confirm'=>'Bạn có muốn xóa cache không?',
            'items'=>[]
        ],

        
    ];
    /**
     * Danh sách quyền được gán cho từng vai trò.
     */
    public array $rolePermissions = [
        'Admin' => [
            'shop.index',
            'tools.index',
            'tools.clearCache',
            'shopdashboard.index',
            'shopcategory.add',
            'shopcategory.index',
            'shopcategory.edit',
            'shopcategory.delete',

            'shopbrand.add',
            'shopbrand.index',
            'shopbrand.edit',
            'shopbrand.delete',

            'shopproduct.add',
            'shopproduct.edit',
            'shopproduct.index',
            'shopproduct.delete',

            'page_section.index',
            'pagehome.index',
            'pagehome.edit',
            'pagehome.update',
            'pagefaq.index',
            'pagefaq.edit',
            'pageabout.index',
            'pageabout.edit',
            'pageservice.index',
            'pageservice.edit',
            'pagetestimonial.index',
            'pagenews.index',
            'pagenews.edit',
            'pageevent.index',
            'pagecontact.index',
            'pagesearch.index',
            'pageteam.index',
            'pageportfolio.index',
            'pagephoto-gallery.index',
            'pagepricing.index',
            'pageterm.index',
            'pageterm.edit',
            'pageprivacy.index',
            'pageprivacy.edit',
            'category.index',
            'category.add',
            'category.edit',
            'category.delete',

            'news.index',
            'news.add',
            'news.edit',
            'news.delete',

            'event.index',
            'event.add',
            'event.edit',
            'event.delete',

            'photo.index',

            'portfolio.index',
            'portfolio.add',
            'portfolio.edit',
            'portfolio.delete',

            'footersetting.index',
            'footersetting.edit',
            'footersetting.update',

            'menugroup.index',
            'menugroup.add',
            'menugroup.edit',
            'menugroup.delete',

            'menu.index',
            'menu.create',
            'menu.edit',
            'menu.delete',

            'lang.index',
            'lang.add',
            'lang.edit',
            'lang.delete',
             'lang.detail',

            'slider.index',
            'slider.add',
            'slider.edit',
            'slider.delete',

            'team.index',
            'team.add',
            'team.edit',
            'team.delete',

            'testimonial.index',
            'testimonial.add',
            'testimonial.edit',
            'testimonial.delete',

            'client.index',
            'client.add',
            'client.edit',
            'client.delete',

            'pricing.index',
            'pricing.add',
            'pricing.edit',
            'pricing.delete',
            /*'subscriber.index',*/
            /*'search.index',*/

            'setting.index',
            'setting.update',
            

            'whychoose.index',
            'whychoose.add',
            'whychoose.edit',
            'whychoose.delete',

            'dashboard.index',

            'user.index',
            'user.add',
            'user.edit',
            'user.delete',

            'service.index',
            'service.add',
            'service.edit',
            'service.delete',

            

            'post.create',
            'post.edit',
            'post.delete',
            'settings.manage',
            'profile.index',
            'profile.update',
            'feature.index',
            'feature.add',
            'feature.edit',
            'feature.delete',
        ],
        'Manager' => [
            'dashboard.index',
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
            'category.add',
            'category.edit',
            'category.delete',

            'news.index',
            'news.add',
            'news.edit',
            'news.delete',

            'event.index',
            'event.add',
            'event.edit',
            'event.delete',

            'photo.index',

            'portfolio.index',
            'portfolio.add',
            'portfolio.edit',
            'portfolio.delete',

            'footersetting.index',
            'footersetting.edit',
            'footersetting.update',

            'menugroup.index',
            'menugroup.add',
            'menugroup.edit',
            'menugroup.delete',

            'menu.index',
            'menu.create',
            'menu.edit',
            'menu.delete',

            'lang.index',
            'lang.add',
            'lang.edit',
            'lang.delete',
             'lang.detail',

            'slider.index',
            'slider.add',
            'slider.edit',
            'slider.delete',

            'team.index',
            'team.add',
            'team.edit',
            'team.delete',

            'testimonial.index',
            'testimonial.add',
            'testimonial.edit',
            'testimonial.delete',

            'client.index',
            'client.add',
            'client.edit',
            'client.delete',

            'pricing.index',
            'pricing.add',
            'pricing.edit',
            'pricing.delete',
            /*'subscriber.index',*/
            /*'search.index',*/

            'setting.index',
            'setting.update',
            

            'whychoose.index',
            'whychoose.add',
            'whychoose.edit',
            'whychoose.delete',

            'dashboard.index',

            'user.index',
            'user.add',
            'user.edit',
            'user.delete',

            'post.create',
            'post.edit',
            'post.delete',
            'settings.manage',
            'profile.index',
            'profile.update',
        ],
        'Editor' => [
            'dashboard.index',
            'category.index',
            'category.add',
            'category.edit',
            'category.delete',

            'news.index',
            'news.add',
            'news.edit',
            'news.delete',

            'event.index',
            'event.add',
            'event.edit',
            'event.delete',

            'photo.index',

            'portfolio.index',
            'portfolio.add',
            'portfolio.edit',
            'portfolio.delete',

            'slider.index',
            'slider.add',
            'slider.edit',
            'slider.delete',
            'profile.index',
            'profile.update'

        ]
    ];
}
