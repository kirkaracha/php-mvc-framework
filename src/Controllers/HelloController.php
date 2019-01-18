<?php declare(strict_types=1);

namespace Framework\Controllers;

final class HelloController extends BaseController
{
    public function index()
    {
        return $this->render('hello/index.html.twig');
    }
}
