<?php

// Set compiled views path for Vercel serverless
if (getenv('VERCEL')) {
    $_ENV['VIEW_COMPILED_PATH'] = '/tmp/views';
    $_ENV['APP_CONFIG_CACHE'] = '/tmp/config.php';
    $_ENV['APP_ROUTES_CACHE'] = '/tmp/routes.php';
    $_ENV['APP_EVENTS_CACHE'] = '/tmp/events.php';
    
    // Ensure tmp directories exist
    if (!is_dir('/tmp/views')) {
        mkdir('/tmp/views', 0755, true);
    }
}

require __DIR__ . '/../public/index.php';