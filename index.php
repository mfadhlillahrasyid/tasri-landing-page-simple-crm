<?php

session_start();

require_once __DIR__ . '/config/Config.php';
require_once __DIR__ . '/config/Pagination.php';
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/app/Enum/userRoles.php';
require_once __DIR__ . '/app/Enum/leadCategories.php';
require_once __DIR__ . '/app/Repository/UserRepository.php';
require_once __DIR__ . '/app/Repository/CustomerRepository.php';
require_once __DIR__ . '/app/Repository/SettingRepository.php';
require_once __DIR__ . '/app/Repository/LogRepository.php';
require_once __DIR__ . '/app/Controller/LandingController.php';
require_once __DIR__ . '/app/Controller/AuthController.php';
require_once __DIR__ . '/app/Controller/Admin/BaseAdminController.php';
require_once __DIR__ . '/app/Controller/Admin/DashboardController.php';
require_once __DIR__ . '/app/Controller/Admin/CustomersController.php';
require_once __DIR__ . '/app/Controller/Admin/SettingsController.php';
require_once __DIR__ . '/app/Controller/Admin/UsersController.php';
require_once __DIR__ . '/app/Controller/Admin/LogsController.php';

$routes = require __DIR__ . '/routes/Web.php';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$base = app_base_url();

if ($base !== '' && str_starts_with($path, $base)) {
    $path = substr($path, strlen($base)) ?: '/';
}

$path = '/' . trim($path, '/');
$path = $path === '/' ? '/' : rtrim($path, '/');

if (!isset($routes[$method][$path])) {
    http_response_code(404);
    echo '404 - Halaman tidak ditemukan';
    exit;
}

[$class, $action] = $routes[$method][$path];
(new $class())->$action();
