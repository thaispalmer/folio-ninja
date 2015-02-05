<?php

class Bcrypt
{
    private static $cost = 10;

    public static function encode($string)
    {
        $salt = substr(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36), 0, 22);
        $param = sprintf('$2a$%02d$%s$', self::$cost, $salt);
        return crypt($string, $param);
    }

    public static function match($string, $encoded)
    {
        return $encoded === crypt($string, $encoded);
    }
}