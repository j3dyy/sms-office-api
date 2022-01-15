<?php

namespace J3dyy\SmsOfficeApi\Office;

use J3dyy\SmsOfficeApi\Client\Request;
use J3dyy\SmsOfficeApi\Client\Response;

class Client
{

    protected OfficeQueryBuilder $builder;

    public function __construct(OfficeQueryBuilder $queryBuilder){
        $this->builder = $queryBuilder;
    }

    public function send(): Response{
        $request = new Request($this->builder);

        return $request->send();
    }

    public function balance(): Response{
        $request = new Request($this->builder);
        return $request->balance();
    }
}