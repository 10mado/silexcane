<?php
namespace Qumu\Enum;

abstract class Enum
{
    protected static $data = [];

    public static function getName($code)
    {
        if (array_key_exists($code, self::$data)) {
            return self::$data[$code];
        }
        return null;
    }

    public static function getCode($name)
    {
        $code = array_search($name, self::$data);
        if ($code !== false) {
            return $code;
        }
        return null;
    }
}
