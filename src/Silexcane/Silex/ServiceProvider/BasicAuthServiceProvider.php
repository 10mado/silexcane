<?php
namespace Silexcane\Silex\ServiceProvider;

use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BasicAuthServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Application $app)
    {
        $app->before(function (Request $req) use ($app) {

            $correctUser = $app['basic_auth.user'];
            $correctPasswordMd5 = $app['basic_auth.password_md5'];

            if (isset($app['basic_auth.pattern'])) {
                $pattern = $app['basic_auth.pattern'];
                $uri = $req->getRequestUri();
                if (!preg_match("|{$pattern}|u", $uri)) {
                    return;
                }
            }

            $realm = 'Secured';
            if (isset($app['basic_auth.realm'])) {
                $realm = $app['basic_auth.realm'];
            }

            $authUser = $req->server->get('PHP_AUTH_USER');
            $authPw = $req->server->get('PHP_AUTH_PW');
            if ($authUser === $correctUser && md5($authPw) === $correctPasswordMd5) {
                return;
            }

            throw new HttpException(Response::HTTP_UNAUTHORIZED, null, null, [
                'WWW-Authenticate' => 'Basic realm="' . $realm . '"',
            ]);
        });
    }

    public function boot(Application $app)
    {
        if (!isset($app['basic_auth.user'], $app['basic_auth.password_md5'])) {
            throw new \LogicException('You must at least set "basic_auth.user" and "basic_auth.password_md5" options.');
        }
    }
}
