
## vendor-account-client

Provides methods to manipulate `AccountClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\AccountClient\ClientFactory;

$clientFactory = ClientFactory::create([
    'base_url' => 'https://my-api.example.com/rest/v1', // optional, in case you need a custom one.
    'basic' => [                                        // use this, it API requires Basic authentication.
        'username' => 'username',
        'password' => 'password',
    ],
    'oauth' => [                                        // use this, it API requires OAuth v2 authentication.
        'token' => [
            'access_token' => 'my-access-token',
            'refresh_token' => 'my-refresh-token',
        ],
    ],
    // other configuration options, if needed
]);

$accountClient = $clientFactory->getAccountClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `AccountClient`, you can use following methods
### Methods

    
Generated JS code


```php

$result = $accountClient->getAccountScripts();
```
---


Standard SQL-style Result filtering


```php
use Paysera\Test\AccountClient\Entity as Entities;

$accountFilter = new Entities\AccountFilter();

$accountFilter->setType($type);
$accountFilter->setAdministeredByUserId($administeredByUserId);
$accountFilter->setOwnedByUserId($ownedByUserId);
$accountFilter->setClosed($closed);
$accountFilter->setReadableByClientId($readableByClientId);
$accountFilter->setActive($active);
    
$result = $accountClient->getAccounts($accountFilter);
```
---

