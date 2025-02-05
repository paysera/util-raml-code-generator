
## vendor-questionnaire-client

Provides methods to manipulate `QuestionnaireClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\QuestionnaireClient\ClientFactory;

$clientFactory = new ClientFactory([
    'base_url' => 'https://my-api.example.com/rest/v1/{locale}/', // optional, in case you need a custom one.
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

$questionnaireClient = $clientFactory->getQuestionnaireClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `QuestionnaireClient`, you can use following methods
### Methods

    
Get questionnaire users by filter


```php

$result = $questionnaireClient->getQuestionnaireUsersIds();
```
---


