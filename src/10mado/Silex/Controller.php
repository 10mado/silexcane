<?php
namespace 10mado\Silex;

use 10mado\Silex\Exception\MustLoginException;
use 10mado\Silex\Exception\MustLogoutException;

class Controller
{
    protected function mustLogin(Application $app)
    {
        if (!$app['is_login']) {
            throw new MustLoginException();
        }
    }

    protected function mustLogout(Application $app)
    {
        if ($app['is_login']) {
            throw new MustLogoutException();
        }
    }
}
