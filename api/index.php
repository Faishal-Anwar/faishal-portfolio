<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if we are running on Vercel
$isVercel = env('VERCEL') || env('NOW_REGION');

if ($isVercel) {
    // Ensure the storage directories exist in /tmp
    $storagePaths = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/app/public',
        '/tmp/storage/logs',
    ];

    foreach ($storagePaths as $path) {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    // Set environment variables for storage if not already set
    putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
    putenv('APP_CONFIG_CACHE=/tmp/storage/framework/cache/config.php');
    putenv('APP_ROUTES_CACHE=/tmp/storage/framework/cache/routes.php');
    putenv('APP_EVENTS_CACHE=/tmp/storage/framework/cache/events.php');
    putenv('APP_PACKAGES_CACHE=/tmp/storage/framework/cache/packages.php');
}

// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once __DIR__ . '/../bootstrap/app.php';

if ($isVercel) {
    // Force the storage path to /tmp
    $app->useStoragePath('/tmp/storage');
}

$app->handleRequest(Request::capture());
