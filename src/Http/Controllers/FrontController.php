<?php declare(strict_types=1);

namespace WhensMyFerry\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

final class FrontController
{
    public function __construct()
    {
    }

    public function show(): Response
    {
        $content = 'Hello';

        return new Response($content);
    }
}
