<?php

namespace J3dyy\SmsOfficeApi\Office;

use J3dyy\SmsOfficeApi\Client\SmsQueryBuilder;

class OfficeQueryBuilder implements SmsQueryBuilder
{
    protected array $query = [];


    function query(): string
    {
        return $this->normalizeQuery();
    }

    function add(...$args)
    {
        $this->query[$args[0]] = $this->parametrify($args);

        return $this;
    }


    private function normalizeQuery(){
        return '&'.implode('&',$this->query);
    }

    private function parametrify(array $params){
        return implode('=',$params);
    }
}