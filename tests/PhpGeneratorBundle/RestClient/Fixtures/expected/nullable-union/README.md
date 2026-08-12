
## vendor-nullable-union-client

Provides methods to manipulate `NullableUnionClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\NullableUnionClient\ClientFactory;

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

$nullableUnionClient = $clientFactory->getNullableUnionClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `NullableUnionClient`, you can use following methods
### Methods

    
Create order


```php
use Paysera\Test\NullableUnionClient\Entity as Entities;

$order = new Entities\Order();

$order->setId($id);
$order->setNote($note);
$order->setDiscount($discount);
$order->setLine($line);
$order->setTags($tags);
$order->setLines($lines);
    
$result = $nullableUnionClient->createOrder($order);
```
---

