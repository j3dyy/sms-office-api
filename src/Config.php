<?php

namespace J3dyy\SmsOfficeApi;


use J3dyy\SmsOfficeApi\Exceptions\ConfigurationException;

class Config
{
    protected array $bag = [];

    private static ?Config $_instance = null;


    private function __construct(){
        $this->define('endpoint','http://smsoffice.ge/api');
    }

    public static function instance(): Config{
        if (self::$_instance == null)
            self::$_instance = new static();
        return self::$_instance;
    }

    public static function endpoint(string $value){
        self::instance()->define('endpoint',$value);
        return self::$_instance;
    }

    public static function apiKey(string $apiKey){
        self::instance()->define('apiKey',$apiKey);
        return self::$_instance;
    }

    public static function sender(string $sender){
        self::instance()->define('sender',$sender);
        return self::$_instance;
    }


    public static function isBasicsDefined(){
        if (self::instance()->get('apiKey') == null){
            throw new ConfigurationException("apiKey not configured example of config: Config::instance()->apiKey('your_api_key')");
        }
    }


    public function define(string $key , $value){
        $this->bag[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key){
        return isset($this->bag[$key]) ? $this->bag[$key] : null;
    }

}