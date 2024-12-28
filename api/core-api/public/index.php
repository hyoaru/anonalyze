<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

if (isset($_SERVER['HTTP_X_FORWARDED_PREFIX'])) {
    URL::forceRootUrl(rtrim($_SERVER['HTTP_X_FORWARDED_PREFIX'], '/'));
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
