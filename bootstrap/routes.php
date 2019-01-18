<?php declare(strict_types=1);

return [
    ['GET', '/', ['Framework\Controllers\HelloController', 'index']],
    ['GET', '/goodbye', ['Framework\Controllers\GoodbyeController', 'index']],
//    ['GET', '/greet/{name}', ['Framework\Controllers\GreetController', 'greet']],
];
