### Installation
```
composer require j3dyy/sms-office-api
```

### Configuration
smsoffice.ge  apiKey need define to config
```php
<?php
Config::instance()->apiKey('yourApiKey');

//Extra
// if you need in some purpose you can use config instance like collection
Config::instance()->define('foo','bar');

Config::instance()->endpoint('customurl.custom')
```

### Sending sms

```php
<?php

//example 1
Smsclient::instance()
    ->send('123123123','your message text','sender')

// example 2
SmsClient::instance()
    ->isUrgent()
    ->to('123123123')
    ->sender('messagesender')
    ->message('messeagecontent')
    ->send();
```