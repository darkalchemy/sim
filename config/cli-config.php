<?php

// Autoload de composer
if (file_exists(dirname(__DIR__).'/vendor/autoload.php')) {
    require dirname(__DIR__).'/vendor/autoload.php';
} else {
    die("Need to install dependencies with composer");
}

return (new \Horyzone\Sim\Init())->cli();
