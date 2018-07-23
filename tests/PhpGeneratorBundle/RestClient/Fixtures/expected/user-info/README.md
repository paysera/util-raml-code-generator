
## vendor-user-info-client

Provides methods to manipulate `UserInfoClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\UserInfoClient\ClientFactory;

$clientFactory = new ClientFactory([
    'base_url' => 'https://example.com/user/rest/v1', // optional, in case you need a custom one.
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

$userInfoClient = $clientFactory->getUserInfoClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `UserInfoClient`, you can use following methods
### Methods

    
Creates Legal User


```php
use Paysera\Test\UserInfoClient\Entity as Entities;

$legal = new Entities\Legal();

$legal->setCompanyName($companyName);
$legal->setCompanyCode($companyCode);
$legal->setVatCode($vatCode);
    
$userInfoClient->createLegalUser($legal);
```
---


Creates Natural User


```php
use Paysera\Test\UserInfoClient\Entity as Entities;

$natural = new Entities\Natural();

$natural->setName($name);
$natural->setSurname($surname);
    
$userInfoClient->createNaturalUser($natural);
```
---


Get user by it&#039;s id


```php

$result = $userInfoClient->getUserInformation($id);
```
---

Updates user resource


```php
use Paysera\Test\UserInfoClient\Entity as Entities;

$userInfo = new Entities\UserInfo();

$userInfo->setId($id);
$userInfo->setType($type);
$userInfo->setCreatedTimestamp($createdTimestamp);
$userInfo->setCreatedDatetime($createdDatetime);
$userInfo->setCreatedDateOnly($createdDateOnly);
$userInfo->setCreatedTimeOnly($createdTimeOnly);
$userInfo->setCreatedDatetimeOnly($createdDatetimeOnly);
    
$result = $userInfoClient->updateUserInformation($id, $userInfo);
```
---



