<?php declare(strict_types=1);

namespace WhensMyFerry\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

final class AdminController
{
    public function __construct()
    {
    }

    public function show(): Response
    {
        $content = 'Admin controller';

        return new Response($content);
    }
}
