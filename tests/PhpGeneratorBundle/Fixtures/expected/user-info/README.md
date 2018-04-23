
## vendor-user-info-client

Provides methods to manipulate `UserInfo` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\TestClient\ClientFactory;

$clientFactory = ClientFactory::create([
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

    
Get user by it&#039;s id


```php

$result = $userInfoClient->getUserInformation($id);
```
---

Updates user resource


```php
use Paysera\Test\TestClient\Entity as Entities;

$userInfo = new Entities\UserInfo();

$userInfo->setId($id);
$userInfo->setType($type);
    
$result = $userInfoClient->informationUser($id, $userInfo);
```
---



