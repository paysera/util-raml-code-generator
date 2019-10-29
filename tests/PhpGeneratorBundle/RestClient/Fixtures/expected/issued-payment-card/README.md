
## vendor-issued-payment-card-client

Provides methods to manipulate `IssuedPaymentCardClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\IssuedPaymentCardClient\ClientFactory;

$clientFactory = new ClientFactory([
    'base_url' => 'https://accounts.paysera.com/public/issued-payment-card/v1/', // optional, in case you need a custom one.
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

$issuedPaymentCardClient = $clientFactory->getIssuedPaymentCardClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `IssuedPaymentCardClient`, you can use following methods
### Methods

    
Price by payer country, client type and card owner id


```php

$result = $issuedPaymentCardClient->getCardIssuePrice($country, $clientType, $cardOwnerId);
```
---


