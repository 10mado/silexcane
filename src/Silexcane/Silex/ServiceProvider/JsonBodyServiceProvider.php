<?php
namespace Silexcane\Silex\ServiceProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class JsonBodyServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app->before(function (Request $req) {
            if (0 === strpos($req->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($req->getContent(), true);
                $req->request->replace(is_array($data) ? $data : []);
            }
        });
    }
}

