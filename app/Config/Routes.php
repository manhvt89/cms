<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

// Load hệ thống mặc định
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Load routes cho frontend
if (file_exists(APPPATH . 'Config/Routes/frontend.php')) {
    require APPPATH . 'Config/Routes/frontend.php';
}

// Load routes cho backend
if (file_exists(APPPATH . 'Config/Routes/backend.php')) {
    require APPPATH . 'Config/Routes/backend.php';
}
