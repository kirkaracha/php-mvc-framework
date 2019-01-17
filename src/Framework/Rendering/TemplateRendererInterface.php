<?php declare(strict_types=1);

namespace WhensMyFerry\Framework\Rendering;

interface TemplateRendererInterface
{
    public function render(string $template, array $data = []): string;
}
