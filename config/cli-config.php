<?php

// Autoload de composer
if (file_exists(dirname(__DIR__).'/vendor/autoload.php')) {
    require dirname(__DIR__).'/vendor/autoload.php';
} else {
    die("Need to install dependencies with composer");
}

$dotenv = new Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load(true);

if (getenv('ENV') == 'dev') {
    $db = "D";
} elseif (getenv('ENV') == 'prod') {
    $db = "P";
}

$doctrine = [
    'driver' => getenv('DB'.$db.'_TYPE'),
    'host' => getenv('DB'.$db.'_SERVER'),
    'dbname' => getenv('DB'.$db.'_NAME'),
    'user' => getenv('DB'.$db.'_USER'),
    'password' => getenv('DB'.$db.'_PWD')
];

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    ['app/src/Entity'],
    true,
    dirname(__DIR__).'/app/cache/proxies',
    null,
    false
);
$em = \Doctrine\ORM\EntityManager::create($doctrine, $config);
return Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($em);
