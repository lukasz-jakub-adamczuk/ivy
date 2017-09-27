<?php

// settings
date_default_timezone_set('Europe/Warsaw');
setlocale(LC_ALL, 'pl_PL.UTF8');

// env setup
$env = getenv('IVY_ENV');

if (!$env) {
    $httpHost = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';

    switch ($httpHost) {
        case 'admin.squarezone.pl':
            $env = 'prod';
            break;
        case 'dev.admin.squarezone.pl':
            $env = 'dev';
            break;
        default:
        case 'admin.squarezone.dev':
            $env = 'local';
            break;
    }
    $_ENV['app'] = $env;
}

// config loading
if ($env == 'prod') {
    error_reporting(0);
    require_once __DIR__ . '/config/prod.php';
}
if ($env == 'dev') {
    // error_reporting(0);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once __DIR__ . '/config/dev.php';
}
if ($env == 'local') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once __DIR__ . '/config/local.php';
}
