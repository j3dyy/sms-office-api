<?php

namespace J3dyy\SmsOfficeApi\Client\Model;

class Balance implements ResponseBody
{
    private $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    public function balance(){
        $this->balance = 20;
    }


    function toJson()
    {
        $encoded = json_encode("{balance: $this->balance}");
        return $encoded ?: null;
    }
}