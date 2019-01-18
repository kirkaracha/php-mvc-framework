<?php declare(strict_types=1);

namespace WhensMyFerry\Controllers;

final class GoodbyeController extends BaseController
{
    public function index()
    {
        return $this->render('goodbye/index.html.twig');
    }
}
