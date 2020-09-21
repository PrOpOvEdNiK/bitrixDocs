<?php

class Core_Helper {

    protected static $sessionSalt = 'R2QZE04chCttf0WsctLYbjxqdYBw39eNxCUM6DIYrzWQFy5VeR';

    public static function generatePass($length=10, $passChars=false) {
        static $allchars = "abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789";
        $string = "";
        if (is_array($passChars)) {
            while (strlen($string) < $length) {
                if (function_exists('shuffle')) {
                    shuffle($passChars);
                }
                foreach ($passChars as $chars) {
                    $n = strlen($chars) - 1;
                    $string .= $chars[mt_rand(0, $n)];
                }
            }
            if (strlen($string) > count($passChars)) {
                $string = substr($string, 0, $length);
            }
        } else {
            if ($passChars !== false) {
                $chars = $passChars;
                $n     = strlen($passChars) - 1;
            } else {
                $chars = $allchars;
                $n     = 61; //strlen($allchars)-1;
            }
            for ($i = 0; $i < $length; $i++) {
                $string .= $chars[mt_rand(0, $n)];
            }
        }
        return $string;
    }

    public static function generateCsrfToken() {
        $sessid = session_id();
        return md5($sessid . static::$sessionSalt);
    }

    public static function checkCsrfToken($token) {
        $myToken = static::generateCsrfToken();
        return ($token == $myToken);
    }
}