<?php declare(strict_types=1);

namespace Framework\Controllers;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Twig_Error_Loader;
use Twig_Error_Runtime;
use Twig_Error_Syntax;

class BaseController
{
    /** @var Twig_Environment $twig */
    private $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render($template)
    {
        try {
            $response = new Response($this->twig->render($template));
        } catch (Twig_Error_Loader $e) {
            $response = new Response('Twig loader error: ' . $e->getMessage());
        } catch (Twig_Error_Runtime $e) {
            $response = new Response('Twig runtime error: ' . $e->getMessage());
        } catch (Twig_Error_Syntax $e) {
            $response = new Response('Twig syntax error: ' . $e->getMessage());
        }

        return $response;
    }

    /** @throws Exception */
    public function exception(): void
    {
        throw new Exception('Test exception');
    }
}
