<?php
namespace Silexcane\Silex\ServiceProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MongoServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        if (!isset($app['mongodb.server'])) {
            $app['mongodb.server'] = 'mongodb://localhost';
        }
        if (!isset($app['mongodb.options'])) {
            $app['mongodb.options'] = [];
        }
        $app['mongodb.client'] = function() use ($app) {
            return new \MongoClient($app['mongodb.server'], $app['mongodb.options']);
        };
    }
}
