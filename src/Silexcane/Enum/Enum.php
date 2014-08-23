<?php
namespace Silexcane\Enum;

abstract class Enum
{
    protected static $data = [];

    public static function all()
    {
        return static::$data;
    }

    public static function getName($code)
    {
        if (array_key_exists($code, static::$data)) {
            return static::$data[$code];
        }
        return null;
    }

    public static function getCode($name)
    {
        $code = array_search($name, static::$data);
        if ($code !== false) {
            return $code;
        }
        return null;
    }
}
