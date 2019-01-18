<?php declare(strict_types=1);

return [
    ['GET', '/', ['WhensMyFerry\Controllers\HelloController', 'index']],
    ['GET', '/goodbye', ['WhensMyFerry\Controllers\GoodbyeController', 'index']],
//    ['GET', '/greet/{name}', ['WhensMyFerry\Controllers\GreetController', 'greet']],
];
