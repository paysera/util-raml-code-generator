
## vendor-money-collection-client

Provides methods to manipulate `MoneyCollectionClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\MoneyCollectionClient\ClientFactory;

$clientFactory = new ClientFactory([
    'base_url' => 'https://example.com/accounts/rest/v1/', // optional, in case you need a custom one.
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

$moneyCollectionClient = $clientFactory->getMoneyCollectionClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `MoneyCollectionClient`, you can use following methods
### Methods

    



```php

$result = $moneyCollectionClient->getAccountBalances($accountNumber);
```
---

