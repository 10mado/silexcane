<?php
namespace Silexcane\Silex;

class Application extends \Silex\Application
{
    use \Silex\Application\TwigTrait;
    use \Silex\Application\UrlGeneratorTrait;

    public function xml($template, array $values = [])
    {
        $response = $this->render($template, $values);
        $response->headers->set('Content-Type', 'application/xml');
        return $response;
    }
}
