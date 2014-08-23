<?php
namespace Silexcane\Silex\Service;

use Silexcane\Silex\Service;

class SecurityTokenValidator extends Service
{
    const SECURITY_TOKEN_ITEM_NAME = 'security-token';

    public function validate()
    {
        $savedToken = $this->app['session']->getId();
        $postedToken = $this->app['request']->request->get(self::SECURITY_TOKEN_ITEM_NAME);
        if (!is_null($postedToken) && $postedToken === $savedToken) {
            return true;
        }
        return false;
    }
}
