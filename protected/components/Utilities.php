<?php

class Utilities
{
    /**
     * Cut a string to a certain number of words
     * @param string $string String to be cut.
     * @param integer $wordLimit Limit of words to show.
     * @param bool $points if suspension points should be added to the string or not. (default: true)
     * @return string
     */
    public static function limitWords($string, $wordLimit, $points = true)
    {
        $words = explode(" ", $string);
        $newString = implode(" ", array_splice($words, 0, $wordLimit));
        return $newString . (($points && ($string != $newString)) ? '...' : '');
    }
}