<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Determine if we are running on Vercel
$isVercel = getenv('VERCEL') || getenv('NOW_REGION');

if ($isVercel) {
    // Set storage path to /tmp for Vercel's read-only filesystem
    $storagePath = '/tmp/storage';
    $paths = [
        $storagePath . '/framework/views',
        $storagePath . '/framework/cache',
        $storagePath . '/framework/sessions',
        $storagePath . '/bootstrap/cache',
        $storagePath . '/app/public',
        $storagePath . '/logs',
    ];

    foreach ($paths as $path) {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    // Set essential environment variables for Vercel
    // These tell Laravel exactly where to write its manifest files
    putenv("APP_SERVICES_CACHE=$storagePath/bootstrap/cache/services.php");
    putenv("APP_PACKAGES_CACHE=$storagePath/bootstrap/cache/packages.php");
    putenv("APP_CONFIG_CACHE=$storagePath/bootstrap/cache/config.php");
    putenv("APP_ROUTES_CACHE=$storagePath/bootstrap/cache/routes.php");
    putenv("APP_EVENTS_CACHE=$storagePath/bootstrap/cache/events.php");
    
    putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");
    putenv("CACHE_STORE=array");
    putenv("SESSION_DRIVER=cookie");
}

// Bootstrap Laravel and handle the request...
$app = require __DIR__ . '/../bootstrap/app.php';

if ($isVercel) {
    $app->useStoragePath($storagePath);
}

$app->handleRequest(Request::capture());
