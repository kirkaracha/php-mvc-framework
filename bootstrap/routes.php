<?php declare(strict_types=1);

return [
    ['GET', '/', ['WhensMyFerry\Http\Controllers\FrontController', 'show']],
    ['GET', '/admin', ['WhensMyFerry\Http\Controllers\AdminController', 'show']],
//    ['GET', '/greet/{name}', ['WhensMyFerry\Controllers\GreetController', 'greet']],
];
