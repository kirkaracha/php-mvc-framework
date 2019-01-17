<?php declare(strict_types=1);

use Dotenv\Dotenv;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use League\Container\Container;
use League\Container\ReflectionContainer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use function FastRoute\simpleDispatcher;

require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

/** Dotenv initialization */

$dotenv = Dotenv::create(__DIR__ . '/../');
$dotenv->load();
$mode = getenv('MODE');

/** Error handler*/

$whoops = new Run;

if ($mode === 'development') {
    $whoops->pushHandler(new PrettyPageHandler);
} else {
    $whoops->pushHandler(
        function () use ($request) {
            Response::create('An internal server error has occurred.', Response::HTTP_INTERNAL_SERVER_ERROR)
                ->prepare($request)
                ->send();
        }
    );
}

$whoops->register();

/** Container */

$container = new Container();

$container
    ->add('Twig_Environment');
//    ->withArgument(
//        new Twig_Loader_Filesystem(__DIR__ . '/../views/')
//    );

$container
    ->delegate(
        new ReflectionContainer()
    );

/** Routes */

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    $routes = require __DIR__ . '/routes.php';

    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
});

/** Dispatch */

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        $response = Response::create('404 Not Found', Response::HTTP_NOT_FOUND);
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        $response = Response::create('405 Method Not Allowed', Response::HTTP_METHOD_NOT_ALLOWED);
        break;
    case Dispatcher::FOUND:
        $fullyQualifiedName = $routeInfo[1][0];
        $routeMethod = $routeInfo[1][1];
        $routeParams = $routeInfo[2];

        $controller = $container->get($fullyQualifiedName);

        $response = $controller->$routeMethod($routeParams);
        break;
    default:
        $response = Response::create(
            'Received unexpected response from dispatcher',
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
        break;
}

if ($response instanceof Response) {
    $response->prepare($request);
    $response->send();
}
