### Installation
```
composer require j3dyy/sms-office-api
```

### Configuration
smsoffice.ge  apiKey need define to config
```php
<?php

Config::apiKey('yourApiKey');

// you can globally add sender
Config::sender('sender');

//if needed in some purpose to use custom office endpoint
Config::endpoint('custom.url');

// or you can call chunked 
Config::apiKey('yourApiKey')
    ->endpoint('custom.url');

//Extra
// if you need in some purpose use it like config bag 
// you can use config instance like collection
Config::instance()->define('foo','bar');

Config::instance()->endpoint('customurl.custom')
```

### Sending sms
```php
<?php

//example 1
Smsclient::instance()
    ->send('123123123','your message text','sender if needed')

// example 2
SmsClient::instance()
    ->isUrgent()
    ->to('123123123')
    ->sender('messagesender')
    ->message('messeagecontent')
    ->send();

//then you can check 
$response = Smsclient::instance()
    ->send('123123123','your message text','sender')
    
if($response->isSuccess()){
 // do something
 $response->getCode();
}
```

