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

    // Set essential environment variables
    putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");
}

try {
    // Bootstrap Laravel and handle the request...
    $app = require __DIR__ . '/../bootstrap/app.php';

    if ($isVercel) {
        $app->useStoragePath($storagePath);
        
        // Ensure bootstrap cache is also in /tmp
        if (method_exists($app, 'setBootstrapCachePath')) {
            $app->setBootstrapCachePath($storagePath . '/bootstrap/cache');
        } elseif (method_exists($app, 'useBootstrapCachePath')) {
             $app->useBootstrapCachePath($storagePath . '/bootstrap/cache');
        }
    }

    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    // Catch everything and display it clearly for debugging
    header('Content-Type: text/plain');
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "FILE: " . $e->getFile() . " LINE: " . $e->getLine() . "\n";
    echo "STACK TRACE:\n" . $e->getTraceAsString();
    exit(1);
}
