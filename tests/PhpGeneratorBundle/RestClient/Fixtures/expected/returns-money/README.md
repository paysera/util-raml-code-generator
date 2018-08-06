
## vendor-returns-money-client

Provides methods to manipulate `ReturnsMoneyClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\ReturnsMoneyClient\ClientFactory;

$clientFactory = new ClientFactory([
    'base_url' => 'https://example.com/accounts/rest/v1/', // optional, in case you need a custom one.
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

$returnsMoneyClient = $clientFactory->getReturnsMoneyClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `ReturnsMoneyClient`, you can use following methods
### Methods

    



```php

$result = $returnsMoneyClient->getAccountBalanceReserved($accountNumber);
```
---

