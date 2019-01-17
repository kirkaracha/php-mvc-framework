<?php declare(strict_types=1);

namespace WhensMyFerry\Framework\Rendering;

use Twig_Environment;
use Twig_Error_Loader;
use Twig_Error_Runtime;
use Twig_Error_Syntax;

final class TwigTemplateRenderer implements TemplateRendererInterface
{
    /** @var Twig_Environment $twigEnvironment */
    private $twigEnvironment;

    public function __construct(Twig_Environment $twigEnvironment)
    {
        $this->twigEnvironment = $twigEnvironment;
    }

    public function render(string $template, array $data = []): string
    {
        $renderedTemplate = '';

        try {
            $renderedTemplate = $this->twigEnvironment->render($template, $data);
        } catch (Twig_Error_Loader $e) {
        } catch (Twig_Error_Runtime $e) {
        } catch (Twig_Error_Syntax $e) {
        } finally {
            return $renderedTemplate;
        }
    }
}
