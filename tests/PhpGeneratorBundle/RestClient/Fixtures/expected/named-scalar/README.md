
## vendor-named-scalar-client

Provides methods to manipulate `NamedScalarClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\NamedScalarClient\ClientFactory;

$clientFactory = new ClientFactory([
    'base_url' => 'https://my-api.example.com/rest/v1/', // optional, in case you need a custom one.
    'mac' => [                                          // use this, if API requires Mac authentication.
        'mac_id' => 'my-mac-id',
        'mac_secret' => 'my-mac-secret',
    ],
    'basic' => [                                        // use this, if API requires Basic authentication.
        'username' => 'username',
        'password' => 'password',
    ],
    'oauth' => [                                        // use this, if API requires OAuth v2 authentication.
        'token' => [
            'access_token' => 'my-access-token',
            'refresh_token' => 'my-refresh-token',
        ],
    ],
    // other configuration options, if needed
]);

$namedScalarClient = $clientFactory->getNamedScalarClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `NamedScalarClient`, you can use following methods
### Methods

    
Create payment


```php
use Paysera\Test\NamedScalarClient\Entity as Entities;

$payment = new Entities\Payment();

$payment->setId($id);
$payment->setCurrency($currency);
$payment->setAllowedCurrencies($allowedCurrencies);
$payment->setAccountNumber($accountNumber);
$payment->setScanResult($scanResult);
$payment->setFilterMode($filterMode);
$payment->setMetadata($metadata);
$payment->setSearchMetadata($searchMetadata);
    
$result = $namedScalarClient->createPayment($payment);
```
---

    
List currencies


```php

$result = $namedScalarClient->getCurrencies();
```
---

