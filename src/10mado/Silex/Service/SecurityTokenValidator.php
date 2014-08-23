<?php
namespace 10mado\Silex\Service;

use 10mado\Silex\Service;

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
