
## vendor-sky-net-client

Provides methods to manipulate `SkyNetClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\SkyNetClient\ClientFactory;

$clientFactory = new ClientFactory([
    'base_url' => 'http://example.com/sky-net/rest/v1/', // optional, in case you need a custom one.
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

$skyNetClient = $clientFactory->getSkyNetClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `SkyNetClient`, you can use following methods
### Methods

    
Set the target of termination


```php
use Paysera\Test\SkyNetClient\Entity as Entities;

$terminationInput = new Entities\TerminationInput();

$terminationInput->setTargetName($targetName);
    
$result = $skyNetClient->createTermination($terminationInput);
```
---

Change the target of termination


```php
use Paysera\Test\SkyNetClient\Entity as Entities;

$terminationInput = new Entities\TerminationInput();

$terminationInput->setTargetName($targetName);
    
$skyNetClient->updateTermination($terminationInput);
```
---

