<?php
namespace Qumu\Silex\Service;

use Qumu\Silex\Application;
use Qumu\Silex\Service;

class Messages extends Service
{
    public function add($message)
    {
        $this->app['session']->getFlashBag()->add('messages', $message);
    }

    public function all(array $default = [])
    {
        return $this->app['session']->getFlashBag()->get('messages', $default);
    }
}
