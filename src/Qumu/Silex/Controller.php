<?php
namespace Qumu\Silex;

use Qumu\Silex\Exception\MustLoginException;
use Qumu\Silex\Exception\MustLogoutException;

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
