<?php declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WhensMyFerry\Http\Controllers\FrontController;
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

$controller = new FrontController();

$response = $controller->show($request);

if (!$response instanceof Response) {
    throw new Exception('Controller methods must return a response object');
}

$response->prepare($request);
$response->send();