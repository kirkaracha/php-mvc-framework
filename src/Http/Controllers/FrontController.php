<?php declare(strict_types=1);

namespace WhensMyFerry\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WhensMyFerry\Framework\Rendering\TemplateRendererInterface;

final class FrontController
{
    /** @var TemplateRendererInterface $templateRenderer */
    private $templateRenderer;

    public function __construct(TemplateRendererInterface $templateRenderer) {
        $this->templateRenderer = $templateRenderer;
    }

    public function show(Request $request): Response {
        $content = 'Hello, ' . $request->get('name', 'visitor');

        return new Response($content);
    }
}
