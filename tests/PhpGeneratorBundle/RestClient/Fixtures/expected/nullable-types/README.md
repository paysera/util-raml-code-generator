
## vendor-nullable-types-client

Provides methods to manipulate `NullableTypesClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\NullableTypesClient\ClientFactory;

$clientFactory = new ClientFactory([
    'base_url' => 'https://example.com/nullable-types/rest/v1/', // optional, in case you need a custom one.
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

$nullableTypesClient = $clientFactory->getNullableTypesClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `NullableTypesClient`, you can use following methods
### Methods

    
Get an inquiry


```php

$result = $nullableTypesClient->getInquiry($id);
```
---

Update an inquiry


```php
use Paysera\Test\NullableTypesClient\Entity as Entities;

$inquiry = new Entities\Inquiry();

$inquiry->setId($id);
$inquiry->setQuestion($question);
$inquiry->setComment($comment);
$inquiry->setFulfilled($fulfilled);
$inquiry->setReviewedAt($reviewedAt);
$inquiry->setReviewer($reviewer);
    
$result = $nullableTypesClient->updateInquiry($id, $inquiry);
```
---


