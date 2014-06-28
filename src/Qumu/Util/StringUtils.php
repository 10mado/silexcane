<?php
namespace Qumu\Util;

class StringUtils
{
    public static function random($length)
    {
        $result = '';
        $chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[array_rand($chars)];
        }
        return $result;
    }

    public static function uuid()
    {
        $data = null;
        if (function_exists('openssl_random_pseudo_bytes')) {
            $data = openssl_random_pseudo_bytes(16);
        } else {
            $data = file_get_contents('/dev/urandom', false, null, 0, 16);
        }

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
