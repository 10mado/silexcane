<?php
namespace Silexcane\Silex\Util;

use Silexcane\Silex\Application;

class TwigExtension
{
    public static function extend(\Twig_Environment $twig, Application $app)
    {
        $twig->addFilter(new \Twig_SimpleFilter('autolink', function($string) {
            return preg_replace(
                '/((http|https|ftp):\/\/[\w?=&.\/-;#~%\-]+(?![\w\s?&.\/;#~%"=\-]*>))/',
                '<a href="$1" target="_blank" rel="nofollow">$1</a>',
                $string
            );
        }, ['is_safe' => ['html']]));
    }
}
