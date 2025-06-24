<?php
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
$routes->get('term', 'Term::index');
$routes->get('privacy', 'Privacy::index');


$routes->get('event', 'Event::index');
$routes->get('event/index/(:num)', 'Event::index/$1');
$routes->get('event/view/(:num)', 'Event::view/$1');

//$routes->get('category', 'Category::index');
//$routes->get('category/(:num)', 'Category::index/$1');
$routes->get('category/(:segment)', 'Category::index/$1');

$routes->get('news', 'News::index');
$routes->get('news/index/(:num)', 'News::index/$1');
$routes->get('news/view/(:num)', 'News::view/$1');
//$routes->get('news/view/(:segment)', 'News::view/$1');

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
$routes->get('service/(:segment)', 'Service::view/$1');

$routes->get('team', 'Team::index');
$routes->get('team-member/(:num)', 'TeamMember::view/$1');

$routes->get('product', 'Shop::index');
$routes->get('product_detail/(:segment)', 'Shop::view/$1');
$routes->get('cart', 'Team::index');
$routes->get('cart/update', 'Team::index');
$routes->get('cart/remove', 'Team::index');
$routes->get('shop/cat/(:num)', 'Team::index');

$routes->post('newsletter/subscribe', 'Newsletter::subscribe');
$routes->get('get-csrf-token', 'CsrfToken::getCsrf');
$routes->get('newsletter/verify/(:segment)', 'Newsletter::verify/$1');
$routes->post('contact/send_email','Contact::send_email');


/*
$route['product']             = 'web/product';
$route['single/(:num)']       = 'web/single/$1';

$route['cart']                = 'web/cart';
$route['save/cart']           = 'web/save_cart';
$route['update/cart']         = 'web/update_cart';
$route['remove/cart']         = 'web/remove_cart';
$route['user_form']           = 'web/user_form';
$route['get/category/(:num)'] = 'web/category_post/$1';
*/



$routes->get('admin/login', 'Admin\Login::index');
$routes->post('admin', 'Admin\Login::index');
$routes->get('admin/logout', 'Admin\Login::logout');
$routes->get('admin', 'Admin\Login::index');

$routes->get('admin/forget-password','Admin\Forget_password::index');
$routes->post('admin/forget-password','Admin\Forget_password::index');

$routes->get('admin/reset-password/(:segment)','Admin\Reset_password::index/$1');
$routes->post('admin/reset-password/(:segment)','Admin\Reset_password::index/$1');
$routes->get('admin/reset_password/success','Admin\Reset_password::success');

//sitemap.xml
$routes->get('sitemap.xml', 'Sitemap::index');
$routes->get('sitemap/(:segment)/(:num)', 'Sitemap::generate/$1/$2'); // sitemap/news/1

// Sử dụng với domain.com/bai_viet_xxx để cuối cùng
$routes->get('/(:segment)', 'News::view/$1');




//$routes->get('admin/dashboard', 'Admin\Dashboard::index');


