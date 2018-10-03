<?php

namespace Tests\Functional;

use \Horyzone\Sim\Init;
use \Horyzone\Sim\Router;
use \Horyzone\Sim\Middleware;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use PHPUnit\Framework\TestCase;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class BaseTestCase extends TestCase
{
    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @return \Slim\Http\Response
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        $Init = new Init();
        $Router = new Router();
        $Middleware = new Middleware();

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();

        // Use the application settings
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/../../');
        $dotenv->load(true);

        // Instantiate the application
        $app = new App();

        // Set up dependencies
        require __DIR__ . '/../../config/container.php';

        // Register middleware
        if ($this->withMiddleware) {
            $_SESSION = [];
            $app = $Middleware->chargeMiddleware($app, [
                "app" => $app,
                "container" => $container
            ], $Init->getConfigFolder());
        }

        // Register routes
        $app = $Router->chargeRouter($app, [
            "app" => $app,
            "container" => $container
        ], $Init->getConfigFolder());

        // Process the application
        $response = $app->process($request, $response);

        // Return the response
        return $response;
    }
}
