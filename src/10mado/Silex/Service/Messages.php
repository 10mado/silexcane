<?php
namespace 10mado\Silex\Service;

use 10mado\Silex\Application;
use 10mado\Silex\Service;

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
