<?php

namespace J3dyy\SmsOfficeApi;

use J3dyy\SmsOfficeApi\Client\Response;
use J3dyy\SmsOfficeApi\Exceptions\ValidationException;
use J3dyy\SmsOfficeApi\Office\Client;
use J3dyy\SmsOfficeApi\Office\OfficeQueryBuilder;
use J3dyy\SmsOfficeApi\Tools\Validator;

class SmsClient
{
    /**
     * @var OfficeQueryBuilder
     */
    protected OfficeQueryBuilder $officeQueryBuilder;

    /**
     * @var SmsClient|null
     */
    protected static ?SmsClient $_instance = null;

    protected bool $_started = false;

    private function __construct()
    {
        $this->officeQueryBuilder = new OfficeQueryBuilder();
        $this->officeQueryBuilder->add('sender', Config::instance()->get('sender'));
    }


    /**
     * @throws Exceptions\ConfigurationException
     */
    public static function instance(): SmsClient{
        if (self::$_instance == null){
            self::$_instance = new static();
            Config::isBasicsDefined();
        }
        return self::$_instance;
    }



    public function send(?string $to = null, ?string $content = null, ?string $sender = null): Response{

        if ($to != null)
            $this->to($to);

        if ($content)
            $this->message($content);

        if ($sender)
            $this->sender($sender);


        $client = new Client($this->officeQueryBuilder);

        return $client->send();

    }

    public function balance(){
        $client = new Client($this->officeQueryBuilder);
        return $client->balance();
    }

    public function reference(string $reference){
        $this->officeQueryBuilder->add('reference',$reference);
        return $this;
    }

    public function sender(string $sender){
        $this->officeQueryBuilder->add('sender',$sender);
        return $this;
    }

    public function to(string $number){

        if(!Validator::isDigits($number)){
            throw new ValidationException('validation.error');
        }

        $this->officeQueryBuilder->add('destination',$number);
        return $this;
    }

    public function isUrgent(){
        $this->officeQueryBuilder->add("urgent","true");
        return $this;
    }

    public function withShowServiceTime(){
        $this->officeQueryBuilder->add('showServiceTime',"true");
        return $this;
    }

    public function message(string $content){
        $this->officeQueryBuilder->add("content",$content);
        return $this;
    }


}