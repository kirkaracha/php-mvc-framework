<?php declare(strict_types=1);

namespace Framework\Controllers;

final class GoodbyeController extends BaseController
{
    public function index()
    {
        return $this->render('goodbye/index.html.twig');
    }
}
