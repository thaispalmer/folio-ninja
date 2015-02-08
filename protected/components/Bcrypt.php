<?php

class Bcrypt
{
    private static $cost = 10;
    public static function getSettings() { return '$2a$'.self::$cost.'$'; }

    public static function encode($string)
    {
        $salt = substr(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36), 0, 22);
        //$param = sprintf('$2a$%02d$%s$', self::$cost, $salt);
        $param = sprintf('%s%s$', self::getSettings(), $salt);
        return crypt($string, $param);
    }

    public static function match($string, $encoded)
    {
        return $encoded === crypt($string, $encoded);
    }

    public static function isBcrypt($encoded)
    {
        $settings = self::getSettings();
        return (substr($encoded,0,strlen($settings)) == $settings) ? true : false;
    }
}