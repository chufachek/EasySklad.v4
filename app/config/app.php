<?php
define('APP_NAME', 'Easy склад');
define('APP_BASE_PATH', '');

define('APP_URL', 'https://localhost');

define('CSRF_KEY', '_csrf_token');

define('DEFAULT_TIMEZONE', 'Europe/Moscow');

date_default_timezone_set(DEFAULT_TIMEZONE);

function csrf_token()
{
    if (empty($_SESSION[CSRF_KEY])) {
        $_SESSION[CSRF_KEY] = bin2hex(random_bytes(16));
    }
    return $_SESSION[CSRF_KEY];
}

function verify_csrf()
{
    $token = $_POST['csrf_token'] ?? '';
    if (!$token || $token !== ($_SESSION[CSRF_KEY] ?? null)) {
        http_response_code(419);
        echo 'Invalid CSRF token';
        exit;
    }
}

function redirect($path)
{
    header('Location: ' . $path);
    exit;
}

function view($template, $data = [])
{
    extract($data);
    $viewFile = __DIR__ . '/../views/' . $template . '.php';
    if (!file_exists($viewFile)) {
        http_response_code(404);
        echo 'View not found';
        exit;
    }
    include $viewFile;
}
