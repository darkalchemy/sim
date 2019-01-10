<?php
// It's necessary for doctrine commands manual

// Autoload de composer
if (file_exists(dirname(__DIR__).'/vendor/autoload.php')) {
    require_once dirname(__DIR__).'/vendor/autoload.php';
} else {
    die("Need to install dependencies with composer");
}

return (new \Horyzone\Sim\Init())->cli();
