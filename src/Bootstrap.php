<?php declare(strict_types=1);

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

echo 'Hello, from the bootstrap file';
