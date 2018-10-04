<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

// Autoload de composer
if (file_exists(dirname(__DIR__). '/vendor/autoload.php')) {
    require dirname(__DIR__). '/vendor/autoload.php';
} else {
    die("Need to install dependencies with composer");
}

$Init = new \Horyzone\Sim\Init();
$Init->startApp();
