
## vendor-platform-version-client

Provides methods to manipulate `PlatformVersionClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\PlatformVersionClient\ClientFactory;

$clientFactory = new ClientFactory([
    'base_url' => 'https://library-address/rest/v1/', // optional, in case you need a custom one.
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

$platformVersionClient = $clientFactory->getPlatformVersionClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `PlatformVersionClient`, you can use following methods
### Methods

