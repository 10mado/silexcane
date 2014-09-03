<?php
namespace Silexcane\Silex;

use Silexcane\Silex\Exception\MustLoginException;
use Silexcane\Silex\Exception\MustLogoutException;
use Symfony\Component\HttpFoundation\Request;

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

    protected function doesAcceptJson(Request $req)
    {
        $accept = $req->headers->get('Accept');
        if (strpos($accept, 'application/json') !== false) {
            return true;
        }
        return false;
    }
}
