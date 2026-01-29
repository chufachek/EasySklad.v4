<?php
require __DIR__ . '/../vendor/autoload.php';

session_start();

$basePath = dirname(__DIR__);

require $basePath . '/app/config/app.php';
require $basePath . '/app/config/db.php';
require $basePath . '/app/config/plans.php';

require $basePath . '/app/middleware/AuthMiddleware.php';
require $basePath . '/app/middleware/CompanyContextMiddleware.php';
require $basePath . '/app/controllers/AuthController.php';
require $basePath . '/app/controllers/AppController.php';
require $basePath . '/app/controllers/CompanyController.php';
require $basePath . '/app/controllers/BillingController.php';
require $basePath . '/app/controllers/NotifyController.php';

$router = new \Bramus\Router\Router();
$router->setBasePath(APP_BASE_PATH);

$router->before('GET|POST', '/app.*|/c.*|/api.*', function () {
    require __DIR__ . '/../app/middleware/AuthMiddleware.php';
    AuthMiddleware::handle();
});

$router->before('GET|POST', '/c.*|/api.*', function () {
    require __DIR__ . '/../app/middleware/CompanyContextMiddleware.php';
    CompanyContextMiddleware::handle();
});

$router->get('/', function () {
    header('Location: /auth/login');
    exit;
});

$router->match('GET|POST', '/auth/login', function () {
    $controller = new AuthController();
    $controller->login();
});

$router->match('GET|POST', '/auth/register', function () {
    $controller = new AuthController();
    $controller->register();
});

$router->get('/auth/forgot', function () {
    view('layouts/auth', [
        'title' => 'Восстановление',
        'page' => 'pages/forgot',
    ]);
});

$router->post('/auth/logout', function () {
    $controller = new AuthController();
    $controller->logout();
});

$router->get('/app', function () {
    $controller = new AppController();
    $controller->profile();
});

$router->post('/app/profile', function () {
    $controller = new AppController();
    $controller->updateProfile();
});

$router->get('/app/notifications', function () {
    $controller = new NotifyController();
    $controller->index();
});

$router->post('/c/context', function () {
    $controller = new CompanyController();
    $controller->setContext();
});

$router->post('/c/companies/create', function () {
    $controller = new CompanyController();
    $controller->createCompany();
});

$router->get('/c/dashboard', function () {
    $controller = new AppController();
    $controller->dashboard();
});

$router->get('/c/pos', function () {
    $controller = new AppController();
    $controller->pos();
});

$router->get('/c/products', function () {
    $controller = new AppController();
    $controller->products();
});

$router->get('/c/receipts', function () {
    $controller = new AppController();
    $controller->receipts();
});

$router->get('/c/orders', function () {
    $controller = new AppController();
    $controller->orders();
});

$router->get('/c/warehouses', function () {
    $controller = new AppController();
    $controller->warehouses();
});

$router->get('/c/services', function () {
    $controller = new AppController();
    $controller->services();
});

$router->get('/c/billing', function () {
    $controller = new BillingController();
    $controller->index();
});

$router->post('/c/billing/purchase', function () {
    $controller = new BillingController();
    $controller->purchase();
});

$router->get('/c/users', function () {
    $controller = new CompanyController();
    $controller->users();
});

$router->post('/c/invitations/send', function () {
    $controller = new CompanyController();
    $controller->sendInvite();
});

$router->post('/c/invitations/(\d+)/accept', function ($id) {
    $controller = new CompanyController();
    $controller->acceptInvite($id);
});

$router->post('/c/invitations/(\d+)/decline', function ($id) {
    $controller = new CompanyController();
    $controller->declineInvite($id);
});

$router->get('/api/products/search', function () {
    $controller = new AppController();
    $controller->searchProducts();
});

$router->run();
