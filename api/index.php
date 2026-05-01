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
    
    // Efficiently create necessary directories if they don't exist
    if (!is_dir($storagePath . '/framework/views')) {
        mkdir($storagePath . '/framework/views', 0755, true);
        mkdir($storagePath . '/framework/cache', 0755, true);
        mkdir($storagePath . '/framework/sessions', 0755, true);
        mkdir($storagePath . '/bootstrap/cache', 0755, true);
    }

    // Set essential environment variables for Vercel
    putenv("APP_SERVICES_CACHE=$storagePath/bootstrap/cache/services.php");
    putenv("APP_PACKAGES_CACHE=$storagePath/bootstrap/cache/packages.php");
    putenv("APP_CONFIG_CACHE=$storagePath/bootstrap/cache/config.php");
    putenv("APP_ROUTES_CACHE=$storagePath/bootstrap/cache/routes.php");
    putenv("APP_EVENTS_CACHE=$storagePath/bootstrap/cache/events.php");
    
    putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");
    
    // Use 'file' driver instead of 'array' for some persistence across same-worker requests
    putenv("CACHE_STORE=file");
    putenv("CACHE_DIRECTORY=$storagePath/framework/cache");
    
    putenv("SESSION_DRIVER=cookie");
}

// Bootstrap Laravel and handle the request...
$app = require __DIR__ . '/../bootstrap/app.php';

if ($isVercel) {
    $app->useStoragePath($storagePath);
}

$app->handleRequest(Request::capture());
