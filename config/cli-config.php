<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
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
    __DIR__.'/../cache/proxies',
    null,
    false
);
$em = \Doctrine\ORM\EntityManager::create($doctrine, $config);
return ConsoleRunner::createHelperSet($em);
