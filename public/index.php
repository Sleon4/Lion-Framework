<?php

/**
 * ------------------------------------------------------------------------------
 * Register The Auto Loader
 * ------------------------------------------------------------------------------
 * Composer provides a convenient, automatically generated class loader for
 * this application
 * ------------------------------------------------------------------------------
 **/

require_once(__DIR__ . "/../vendor/autoload.php");

/**
 * ------------------------------------------------------------------------------
 * Register environment variable loader automatically
 * ------------------------------------------------------------------------------
 * .dotenv provides an easy way to access environment variables with $_ENV
 * ------------------------------------------------------------------------------
 **/

(Dotenv\Dotenv::createImmutable(__DIR__ . "/../"))->load();

/**
 * ------------------------------------------------------------------------------
 * Import route for RSA
 * ------------------------------------------------------------------------------
 * Load default route for RSA
 * ------------------------------------------------------------------------------
 **/

if ($_ENV['RSA_URL_PATH'] != '') LionSecurity\RSA::$url_path = "../{$_ENV['RSA_URL_PATH']}";

/**
 * ------------------------------------------------------------------------------
 * Web headers
 * ------------------------------------------------------------------------------
 * This is where you can register headers for your application
 * ------------------------------------------------------------------------------
 **/
include_once(__DIR__ . "/../routes/header.php");

/**
 * ------------------------------------------------------------------------------
 * Start database service
 * ------------------------------------------------------------------------------
 * Upload data to establish a connection
 * ------------------------------------------------------------------------------
 **/

$response_conn = LionSQL\Drivers\MySQLDriver::init([
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'db_name' => $_ENV['DB_NAME'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => $_ENV['DB_CHARSET']
]);

if ($response_conn->status === 'error') die(LionRequest\Json::encode($response_conn));

/**
 * ------------------------------------------------------------------------------
 * Web Routes
 * ------------------------------------------------------------------------------
 * Here is where you can register web routes for your application
 * ------------------------------------------------------------------------------
 **/

LionRoute\Route::init();
include_once(__DIR__ . "/../routes/middleware.php");
include_once(__DIR__ . "/../routes/web.php");
LionRoute\Route::get('route-list', fn() => LionRoute\Route::getRoutes());
LionRoute\Route::dispatch();