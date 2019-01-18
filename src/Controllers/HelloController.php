<?php declare(strict_types=1);

namespace WhensMyFerry\Controllers;

final class HelloController extends BaseController
{
    public function index()
    {
        return $this->render('hello/index.html.twig');
    }
}
