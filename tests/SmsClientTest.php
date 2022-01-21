<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use J3dyy\SmsOfficeApi\Exceptions\ConfigurationException;
use J3dyy\SmsOfficeApi\Exceptions\ValidationException;
use J3dyy\SmsOfficeApi\Config;
use J3dyy\SmsOfficeApi\SmsClient;

class SmsClientTest extends TestCase
{

    public function testConfigurationException(): void
    {
        $this->expectException(
            ConfigurationException::class
        );

        SmsClient::instance()->send('s','message');
    }

    public function testNumberValicationException(): void
    {
        $this->expectException(
            ValidationException::class
        );

        Config::apiKey('somekey');

//        SmsClient::instance()->send('123','message');
//        SmsClient::instance()->send('string','message');
        SmsClient::instance()->send('12s3123123','message');
    }

}