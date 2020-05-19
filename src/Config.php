<?php
namespace Hbe\ServiceLog\Sdk;

class Config
{    
    public static $username;
    public static $password;
    public static $environment;
    public static $timeoutMilliseconds;

    public static function initialise($environment, $username, $password, $timeoutMilliseconds = 60000)
    {
        self::$environment = $environment;
        self::$username = $username;
        self::$password = $password;
        self::$timeoutMilliseconds = $timeoutMilliseconds;
    }

    public static function baseUrl()
    {
        if (self::$environment == "sandbox") {
            return "http://micro-log.hotellinksolutions.com/api/v1/";
        } else {
            return "http://micro-log.hotellinksolutions.com/api/v1/";            
        }
    }
}
?>