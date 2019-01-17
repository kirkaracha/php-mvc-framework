<?php declare(strict_types=1);

namespace WhensMyFerry\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use WhensMyFerry\Framework\Rendering\TemplateRendererInterface;

final class AdminController
{
    /** @var TemplateRendererInterface $templateRenderer */
    private $templateRenderer;

    public function __construct(TemplateRendererInterface $templateRenderer) {
        $this->templateRenderer = $templateRenderer;
    }

    public function show(): Response
    {
        $content = 'Admin controller';

        return new Response($content);
    }
}
