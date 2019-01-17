<?php declare(strict_types=1);

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WhensMyFerry\Framework\Rendering\TwigTemplateRendererFactory;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as WhoopsRun;

define('ROOT_DIR', dirname(__DIR__));

require_once ROOT_DIR . '/vendor/autoload.php';

$environment = 'development';

$whoops = new WhoopsRun;

if ($environment !== 'production') {
    $whoops->pushHandler(new PrettyPageHandler);
} else {
    $whoops->pushHandler(function(){
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}

$whoops->register();

$request = Request::createFromGlobals();

$dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $routeCollector) {
    $routes = include(ROOT_DIR . '/src/Routes.php');

    foreach ($routes as $route) {
        $routeCollector->addRoute(...$route);
    }
});

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        $response = new Response (
            'Not found',
            404
        );

        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        $response = new Response (
            'Method not allowed',
            405
        );

        break;
    case Dispatcher::FOUND:
        [$controllerName, $method] = explode('@', $routeInfo[1]);
        $vars = $routeInfo[2];
        $factory = new TwigTemplateRendererFactory();
        $templateRenderer = $factory->create();
        $controller = new $controllerName($templateRenderer);
        //$controller = new $controllerName;
        $response = $controller->$method($request, $vars);

        break;
}

if (!$response instanceof Response) {
    throw new Exception('Controller methods must return a response object');
}

$response->prepare($request);
$response->send();