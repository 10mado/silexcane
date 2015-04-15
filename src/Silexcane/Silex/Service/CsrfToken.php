<?php
namespace Silexcane\Silex\Service;

use Silexcane\Silex\Service;
use Silexcane\Util\StringUtils;

class CsrfToken extends Service
{
    const CSRF_TOKEN_NAME = '_csrf_token';
    const CSRF_TOKEN_HEADER_NAME = 'X-CSRF-TOKEN';

    public function generate()
    {
        if (!$this->app['session']->has(self::CSRF_TOKEN_NAME)) {
            $csrfToken = StringUtils::random(40);
            $this->app['session']->set(self::CSRF_TOKEN_NAME, $csrfToken);
        }
    }

    public function destroy()
    {
        $this->app['session']->delete(self::CSRF_TOKEN_NAME);
    }

    public function verify()
    {
        $savedToken = $this->app['session']->get(self::CSRF_TOKEN_NAME);
        $postedToken = $this->app['request']->request->get(self::CSRF_TOKEN_NAME) ?:
            $this->app['request']->headers->get(self::CSRF_TOKEN_HEADER_NAME);
        if (!is_null($postedToken) && $postedToken === $savedToken) {
            return true;
        }
        return false;
    }
}
