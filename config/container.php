<?php

$container = $app->getContainer();

// Session helper
$container['session'] = function () {
    return new \Adbar\Session("app");
};

// Monolog
$container['logger'] = function ($container) {
    $settings = [
      'name' => 'slim-app',
      'path' => dirname(__DIR__) . '/app/logs/app.log'
    ];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

if (getenv('ENV') == 'local') {
    $container['twig_profile'] = function () {
        return new Twig_Profiler_Profile();
    };
}

// Translator
$container['translator'] = function ($container) {
    $loader = new Illuminate\Translation\FileLoader(
        new Illuminate\Filesystem\Filesystem(),
        dirname(__DIR__) . '/config/translations'
    );

    // Langue par défaut via la session
    $session = $container['session'];
    if (!$session->has('lang')) {
        $session->set('lang', 'en');
    }

    $translator = new Illuminate\Translation\Translator($loader, $session->get('lang'));
    return $translator;
};

// Twig
$container['view'] = function ($container) {
    $pathView = dirname(__DIR__);

    if (slim_env('CACHE')) {
        $cache = $pathView.'/app/cache';
    } else {
        $cache = false;
    }
    $view = new \Slim\Views\Twig($pathView.'/app/src/Views', [
        'cache' => $cache,
        'debug' => true
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    if (getenv('ENV') == 'local') {
        $view->addExtension(new Twig_Extension_Profiler($container['twig_profile']));
        $view->addExtension(new Twig_Extension_Debug());
    }
    $view->addExtension(new App\Extensions\TranslatorExtension($container['translator']));

    return $view;
};

// DBAL de doctrine
$container['dbal'] = function () {
    if (getenv('ENV') == 'local') {
        $db = "D";
    } elseif (getenv('ENV') == 'prod') {
        $db = "P";
    }
    $conn = \Doctrine\DBAL\DriverManager::getConnection([
            'driver' => getenv('DB'.$db.'_TYPE'),
            'host' => getenv('DB'.$db.'_SERVER'),
            'user' => getenv('DB'.$db.'_USER'),
            'password' => getenv('DB'.$db.'_PWD'),
            'dbname' => getenv('DB'.$db.'_NAME'),
            'port' => 3306,
            'charset' => 'utf8'
    ], new \Doctrine\DBAL\Configuration);
    return $conn->createQueryBuilder();
};


// EntityManager de doctrine
$container['em'] = function () {
    if (getenv('ENV') == 'local') {
        $db = "D";
    } elseif (getenv('ENV') == 'prod') {
        $db = "P";
    }
    $connection = [
        'driver' => getenv('DB'.$db.'_TYPE'),
        'host' => getenv('DB'.$db.'_SERVER'),
        'dbname' => getenv('DB'.$db.'_NAME'),
        'user' => getenv('DB'.$db.'_USER'),
        'password' => getenv('DB'.$db.'_PWD')
    ];
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        ['app/src/Entity'],
        true,
        dirname(__DIR__).'/app/cache/doctrine',
        null,
        false
    );
    return \Doctrine\ORM\EntityManager::create($connection, $config);
};

// Csrf
$container['csrf'] = function () {
    $guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", false);
        return $next($request, $response);
    });
    return $guard;
};
