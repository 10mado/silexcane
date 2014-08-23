<?php
namespace Silexcane\Silex;

use Silexcane\Silex\Exception\MustLoginException;
use Silexcane\Silex\Exception\MustLogoutException;

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
