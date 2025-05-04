<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');

//home/send_email
$routes->post('home/send_email', 'Home::send_email');
$routes->get('home/send_email', 'Home::send_email');

$routes->get('test', 'Test::index');
$routes->get('about', 'About::index');
$routes->get('contact', 'Contact::index');
$routes->get('faq', 'Faq::index');

$routes->get('event', 'Event::index');
$routes->get('event/index/(:num)', 'Event::index/$1');
$routes->get('event/view/(:num)', 'Event::view/$1');

//$routes->get('category', 'Category::index');
//$routes->get('category/(:num)', 'Category::index/$1');
$routes->get('category/(:segment)', 'Category::index/$1');

$routes->get('news', 'News::index');
$routes->get('news/index/(:num)', 'News::index/$1');
$routes->get('news/view/(:num)', 'News::view/$1');
$routes->get('news/view/(:segment)', 'News::view/$1');

$routes->get('lang', 'Lang::index');
$routes->post('lang/change', 'Lang::change');

$routes->get('page', 'Page::index');

$routes->get('photogallery', 'Photogallery::index');

$routes->get('portfolio', 'Portfolio::index');
$routes->get('portfolio/index/(:num)', 'Portfolio::index/$1');
$routes->get('portfolio/view/(:segment)', 'Portfolio::view/$1');

$routes->post('search', 'search::index');

$routes->get('service', 'Service::index');
$routes->get('service/index/(:num)', 'Service::index/$1');
$routes->get('service/view/(:num)', 'Service::view/$1');

$routes->get('team', 'Team::index');
$routes->get('team-member/(:num)', 'TeamMember::view/$1');



$routes->group('admin', [
    'namespace' => 'App\Controllers\Admin',
    'filter' => 'auth'
], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Profile::index');
    $routes->post('profile/update', 'Profile::update');
    $routes->get('category', 'Category::index');
    $routes->get('category/add', 'Category::add');
    $routes->post('category/add', 'Category::add');
    $routes->get('category/edit/(:num)', 'Category::edit/$1');
    $routes->post('category/edit/(:num)', 'Category::edit/$1');
    $routes->get('category/delete/(:num)', 'Category::delete/$1');

    $routes->get('news', 'News::index');
    $routes->get('news/add', 'News::add');
    $routes->post('news/add', 'News::add');

    $routes->get('news/edit/(:num)', 'News::edit/$1');
    $routes->post('news/edit/(:num)', 'News::edit/$1');
    $routes->get('news/delete/(:num)', 'News::delete/$1');
    $routes->post('upload/image', 'Upload::image');

    $routes->get('media/popup', 'Media::popup');
    $routes->post('media/upload', 'Media::upload');
    $routes->get('media/ajaxLibrary', 'Media::ajaxLibrary');


    $routes->get('settings', 'Setting::index');
    $routes->get('setting', 'Setting::index');
    //$routes->get('news/add', 'News::add');
    $routes->post('setting/update', 'Setting::update');


    $routes->get('event', 'Event::index');
    $routes->get('event/add', 'Event::add');
    $routes->post('event/add', 'Event::add');

    $routes->get('event/edit/(:num)', 'Event::edit/$1');
    $routes->post('event/edit/(:num)', 'Event::edit/$1');
    $routes->get('event/delete/(:num)', 'Event::delete/$1');


    $routes->get('photo', 'Photo::index');
    $routes->get('photo_gallery', 'Photo::index');
    
    $routes->get('photo/add', 'Photo::add');
    $routes->post('photo/add', 'Photo::add');

    $routes->get('photo/edit/(:num)', 'Photo::edit/$1');
    $routes->post('photo/edit/(:num)', 'Photo::edit/$1');
    $routes->get('photo/delete/(:num)', 'Photo::delete/$1');
    
    $routes->get('portfolio', 'Portfolio::index');
    
    $routes->get('portfolio/add', 'Portfolio::add');
    $routes->post('portfolio/add', 'Portfolio::add');

    $routes->get('portfolio/edit/(:num)', 'Portfolio::edit/$1');
    $routes->post('portfolio/edit/(:num)', 'Portfolio::edit/$1');
    $routes->get('portfolio/delete/(:num)', 'Portfolio::delete/$1');


    $routes->get('footersetting', 'FooterSetting::index');
    
   
    $routes->post('footersetting/update', 'FooterSetting::update');

    $routes->get('footersetting/edit/(:num)', 'FooterSetting::edit/$1');
    $routes->post('footersetting/edit/(:num)', 'FooterSetting::edit/$1');
    $routes->get('footersetting/delete/(:num)', 'FooterSetting::delete/$1');


    // Menu
    //$routes->get('menu', 'Menu::index');
    //$routes->post('menu', 'Menu::index');
    $routes->get('menu/index/(:num)', 'Menu::index/$1');
    $routes->get('menu/create/(:num)', 'Menu::create/$1');
    $routes->post('menu/store/(:num)', 'Menu::store/$1');
    $routes->get('menu/edit/(:num)', 'Menu::edit/$1');
    $routes->post('menu/update/(:num)', 'Menu::update/$1');
    $routes->get('menu/delete/(:num)', 'Menu::delete/$1');

    // Language
    $routes->get('lang', 'Lang::index');
    
   
    $routes->get('lang/add', 'Lang::add');
    $routes->post('lang/add', 'Lang::add');

    $routes->get('lang/edit/(:num)', 'Lang::edit/$1');
    $routes->post('lang/edit/(:num)', 'Lang::edit/$1');
    $routes->get('lang/delete/(:num)', 'Lang::delete/$1');

    $routes->get('lang/detail/(:num)', 'Lang::detail/$1');
    $routes->post('lang/detail/(:num)', 'Lang::detail/$1');


    $routes->get('slider', 'Slider::index');
    
   
    $routes->get('slider/add', 'Slider::add');
    $routes->post('slider/add', 'Slider::add');

    $routes->get('slider/edit/(:num)', 'Slider::edit/$1');
    $routes->post('slider/edit/(:num)', 'Slider::edit/$1');
    $routes->get('slider/delete/(:num)', 'Slider::delete/$1');

    // page-home
    $routes->get('pagehome', 'PageHome::index');
    $routes->get('pagehome/edit/(:num)', 'PageHome::edit/$1');
    $routes->post('pagehome/edit/(:num)', 'PageHome::edit/$1');
    $routes->post('pagehome/update', 'PageHome::update');

    //page about
    $routes->get('pageabout', 'PageAbout::index');
    $routes->get('pageabout/edit/(:num)', 'PageAbout::edit/$1');
    $routes->post('pageabout/edit/(:num)', 'PageAbout::edit/$1');
    $routes->post('pagehome/update', 'PageHome::update');

    //pagefaq
    $routes->get('pagefaq', 'PageFAQ::index');
    $routes->get('pagefaq/edit/(:num)', 'PageFAQ::edit/$1');
    $routes->post('pagefaq/edit/(:num)', 'PageFAQ::edit/$1');
    //pageservice
    $routes->get('pageservice', 'PageService::index');
    $routes->get('pageservice/edit/(:num)', 'PageService::edit/$1');
    $routes->post('pageservice/edit/(:num)', 'PageService::edit/$1');

    //pagenews
    $routes->get('pagenews', 'PageNews::index');
    $routes->get('pagenews/edit/(:num)', 'PageNews::edit/$1');
    $routes->post('pagenews/edit/(:num)', 'PageNews::edit/$1');

    //pageevent
    $routes->get('pageevent', 'PageEvent::index');
    $routes->get('pageevent/edit/(:num)', 'PageEvent::edit/$1');
    $routes->post('pageevent/edit/(:num)', 'PageEvent::edit/$1');

    //pagecontact
    $routes->get('pagecontact', 'PageContact::index');
    $routes->get('pagecontact/edit/(:num)', 'PageContact::edit/$1');
    $routes->post('pagecontact/edit/(:num)', 'PageContact::edit/$1');

    //pageteam
    $routes->get('pageteam', 'PageTeam::index');
    $routes->get('pageteam/edit/(:num)', 'PageTeam::edit/$1');
    $routes->post('pageteam/edit/(:num)', 'PageTeam::edit/$1');

    //pageportfolio
    $routes->get('pageportfolio', 'PagePortfolio::index');
    $routes->get('pageportfolio/edit/(:num)', 'PagePortfolio::edit/$1');
    $routes->post('pageportfolio/edit/(:num)', 'PagePortfolio::edit/$1');

    //pageterm
    $routes->get('pageterm', 'PageTerm::index');
    $routes->get('pageterm/edit/(:num)', 'PageTerm::edit/$1');
    $routes->post('pageterm/edit/(:num)', 'PageTerm::edit/$1');

    //pageprivacy
    $routes->get('pageprivacy', 'PagePrivacy::index');
    $routes->get('pageprivacy/edit/(:num)', 'PagePrivacy::edit/$1');
    $routes->post('pageprivacy/edit/(:num)', 'PagePrivacy::edit/$1');

    //pagesearch
    $routes->get('pagesearch', 'PageSearch::index');
    $routes->get('pagesearch/edit/(:num)', 'PageSearch::edit/$1');
    $routes->post('pagesearch/edit/(:num)', 'PageSearch::edit/$1');

    //Group Menu
    $routes->get('menugroup', 'MenuGroup::index');
    $routes->get('menugroup/create', 'MenuGroup::create');
    $routes->post('menugroup/store', 'MenuGroup::store');
    $routes->get('menugroup/edit/(:num)', 'MenuGroup::edit/$1');
    $routes->get('menugroup/delete/(:num)', 'MenuGroup::delete/$1');
    $routes->post('menu-menugroup/update/(:num)', 'Admin\MenuGroup::update/$1');

    //team
    $routes->get('team', 'Team::index');
    $routes->get('team/edit/(:num)', 'Team::edit/$1');
    $routes->post('team/edit/(:num)', 'Team::edit/$1');

    $routes->get('team/add', 'Team::add');
    $routes->post('team/add', 'Team::add');
    $routes->get('team/delete/(:num)', 'Team::delete/$1');

    //client
    $routes->get('client', 'Client::index');
    $routes->get('client/edit/(:num)', 'Client::edit/$1');
    $routes->post('client/edit/(:num)', 'Client::edit/$1');

    $routes->get('client/add', 'Client::add');
    $routes->post('client/add', 'Client::add');
    $routes->get('client/delete/(:num)', 'Client::delete/$1');

    //service
    $routes->get('service', 'Service::index');
    $routes->get('service/edit/(:num)', 'Service::edit/$1');
    $routes->post('service/edit/(:num)', 'Service::edit/$1');

    $routes->get('service/add', 'Service::add');
    $routes->post('service/add', 'Service::add');
    $routes->get('service/delete/(:num)', 'Service::delete/$1');

    //testimonial
    $routes->get('testimonial', 'Testimonial::index');
    $routes->get('testimonial/edit/(:num)', 'Testimonial::edit/$1');
    $routes->post('testimonial/edit/(:num)', 'Testimonial::edit/$1');

    $routes->get('testimonial/add', 'Testimonial::add');
    $routes->post('testimonial/add', 'Testimonial::add');
    $routes->get('testimonial/delete/(:num)', 'Testimonial::delete/$1');

    //pricing
    $routes->get('pricing', 'Pricing::index');
    $routes->get('pricing/edit/(:num)', 'Pricing::edit/$1');
    $routes->post('pricing/edit/(:num)', 'Pricing::edit/$1');

    $routes->get('pricing/add', 'Pricing::add');
    $routes->post('pricing/add', 'Pricing::add');
    $routes->get('pricing/delete/(:num)', 'Pricing::delete/$1');

    //whychoose
    $routes->get('whychoose', 'WhyChoose::index');
    $routes->get('whychoose/edit/(:num)', 'WhyChoose::edit/$1');
    $routes->post('whychoose/edit/(:num)', 'WhyChoose::edit/$1');

    $routes->get('whychoose/add', 'WhyChoose::add');
    $routes->post('whychoose/add', 'WhyChoose::add');
    $routes->get('whychoose/delete/(:num)', 'WhyChoose::delete/$1');

    //shop/dashboard
    $routes->get('shop/dashboard', 'ShopDashboard::index');

    //shop/add/category
    $routes->get('shop/add/category', 'ShopCategory::add');
    $routes->post('shop/add/category', 'ShopCategory::add');

    $routes->get('shop/manage/category', 'ShopCategory::index');
    $routes->get('shop/edit/category/(:num)', 'ShopCategory::edit/$1');
    $routes->post('shop/edit/category/(:num)', 'ShopCategory::edit/$1');

    $routes->get('shop/delete/category/(:num)', 'ShopCategory::delete/$1');

    //shop/manage/brand
    $routes->get('shop/add/brand', 'ShopBrand::add');
    $routes->post('shop/add/brand', 'ShopBrand::add');

    $routes->get('shop/manage/brand', 'ShopBrand::index');
    $routes->get('shop/edit/brand/(:num)', 'ShopBrand::edit/$1');
    $routes->post('shop/edit/brand/(:num)', 'ShopBrand::edit/$1');

    $routes->get('shop/delete/brand/(:num)', 'ShopBrand::delete/$1');

    //shop/manage/product
    $routes->get('shop/add/product', 'ShopProduct::add');
    $routes->post('shop/add/product', 'ShopProduct::add');
    
    $routes->get('shop/manage/product', 'ShopProduct::index');
    $routes->get('shop/edit/product/(:num)', 'ShopProduct::edit/$1');
    $routes->post('shop/edit/product/(:num)', 'ShopProduct::edit/$1');

    $routes->get('shop/delete/product/(:num)', 'ShopProduct::delete/$1');

});

$routes->get('admin/login', 'Admin\Login::index');
$routes->post('admin', 'Admin\Login::index');
$routes->get('admin/logout', 'Admin\Login::logout');
$routes->get('admin', 'Admin\Login::index');

//$routes->get('admin/dashboard', 'Admin\Dashboard::index');

