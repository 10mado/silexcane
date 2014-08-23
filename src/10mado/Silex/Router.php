<?php
namespace 10mado\Silex;

abstract class Router
{
    protected $namespace = 'App';
    protected $isHttpsForced = false;
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    // ex) $this->routeGet('/', 'TopController::getAction', 'top');
    public abstract function route();

    public function forceHttps()
    {
        $this->isHttpsForced = true;
    }

    protected function routeGet($path, $controllerName, $bindName, $forceHttps = false)
    {
        if ($this->isHttpsForced || $forceHttps) {
            $this->app
                ->get($path, "\\{$this->namespace}\\Controller\\" . $controllerName)
                ->bind($bindName)
                ->requireHttps();
        } else {
            $this->app
                ->get($path, "\\{$this->namespace}\\Controller\\" . $controllerName)
                ->bind($bindName);
        }
    }

    protected function routePost($path, $controllerName, $forceHttps = false)
    {
        if ($this->isHttpsForced || $forceHttps) {
            $this->app
                ->post($path, "\\{$this->namespace}\\Controller\\" . $controllerName)
                ->requireHttps();
        } else {
            $this->app
                ->post($path, "\\{$this->namespace}\\Controller\\" . $controllerName);
        }
    }

    protected function routePut($path, $controllerName, $forceHttps = false)
    {
        if ($this->isHttpsForced || $forceHttps) {
            $this->app
                ->put($path, "\\{$this->namespace}\\Controller\\" . $controllerName)
                ->requireHttps();
        } else {
            $this->app
                ->put($path, "\\{$this->namespace}\\Controller\\" . $controllerName);
        }
    }

    protected function routeDelete($path, $controllerName, $forceHttps = false)
    {
        if ($this->isHttpsForced || $forceHttps) {
            $this->app
                ->delete($path, "\\{$this->namespace}\\Controller\\" . $controllerName)
                ->requireHttps();
        } else {
            $this->app
                ->delete($path, "\\{$this->namespace}\\Controller\\" . $controllerName);
        }
    }

    protected function routePermanentRedirect($path, $bindName)
    {
        $app = $this->app;
        $this->app->get($path, function() use ($app, $bindName) {
            return $app->redirect($app->url($bindName), 301);
        });
    }
}
