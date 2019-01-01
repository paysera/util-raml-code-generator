
## vendor-public-transfers-client

Provides methods to manipulate `PublicTransfersClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\PublicTransfersClient\ClientFactory;

$clientFactory = new ClientFactory([
    'base_url' => 'https://accounts.paysera.com/some/rest/v1/', // optional, in case you need a custom one.
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

$publicTransfersClient = $clientFactory->getPublicTransfersClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `PublicTransfersClient`, you can use following methods
### Methods

    
Returns the amount required as an addition to the account balance in order to be able to execute the transfer.


```php

$result = $publicTransfersClient->getTransferRequiredSupplement($transferId);
```
---


Unlocks SMS challenge


```php

$publicTransfersClient->updateTransferSms($transferId);
```
---



