<?php

// Monolog
$container['logger'] = function ($container) {
    $settings = [
      'name' => 'sim-app',
      'path' => dirname(__DIR__) . '/app/logs/app.log'
    ];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
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

// Swiftmailer
$container['mailer'] = function () {
    if (getenv('SMTP_USER') != null && getenv('SMTP_PASSWORD') != null) {
        $transport = (new Swift_SmtpTransport(getenv('SMTP_HOST'), getenv('SMTP_PORT')))
            ->setUsername(getenv('SMTP_USER'))
            ->setPassword(getenv('SMTP_PASSWORD'));
    } else {
        $transport = new Swift_SmtpTransport(getenv('SMTP_HOST'), getenv('SMTP_PORT'));
    }
    return new Swift_Mailer($transport);
};
