<?php declare(strict_types=1);

namespace WhensMyFerry\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class FrontController extends BaseController
{
    public function show(Request $request): Response {
        $content = 'Hello, ' . $request->get('name', 'visitor');

        return new Response($content);
    }
}
