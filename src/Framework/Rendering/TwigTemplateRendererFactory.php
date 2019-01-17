<?php declare(strict_types=1);

namespace WhensMyFerry\Framework\Rendering;

use Twig_Environment;
use Twig_Loader_Filesystem;

final class TwigTemplateRendererFactory
{
    public function create(): TwigTemplateRenderer
    {
        $loader = new Twig_Loader_Filesystem([]);
        $twigEnvironment = new Twig_Environment($loader);

        return new TwigTemplateRenderer($twigEnvironment);
    }
}
