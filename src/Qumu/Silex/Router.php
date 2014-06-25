<?php
namespace Qumu\Silex;

use Siex\Application;

abstract class Router
{
    protected $namespace = 'App';
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    // ex) $this->routeGet('/', 'TopController::getAction', 'top');
    public abstract function route();

    protected function routeGet($path, $controllerName, $bindName)
    {
        $this->app->get($path, "\\{$this->naemspace}\\Controller\\" . $controllerName)->bind($bindName);
    }

    protected function routePost($path, $controllerName)
    {
        $this->app->post($path, "\\{$this->naemspace}\\Controller\\" . $controllerName);
    }

    protected function routePut($path, $controllerName)
    {
        $this->app->put($path, "\\{$this->naemspace}\\Controller\\" . $controllerName);
    }

    protected function routeDelete($path, $controllerName)
    {
        $this->app->delete($path, "\\{$this->naemspace}\\Controller\\" . $controllerName);
    }

    protected function routePermanentRedirect($path, $bindName)
    {
        $app = $this->app;
        $this->app->get($path, function() use ($app, $bindName) {
            return $app->redirect($app->url($bindName), 301);
        });
    }
}
