
## vendor-transfer-surveillance-assistant-client

Provides methods to manipulate `TransferSurveillanceAssistantClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\TransferSurveillanceAssistantClient\ClientFactory;

$clientFactory = new ClientFactory([
    'base_url' => 'http://example.com/transfer-surveillance-assistant/rest/v1/', // optional, in case you need a custom one.
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

$transferSurveillanceAssistantClient = $clientFactory->getTransferSurveillanceAssistantClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `TransferSurveillanceAssistantClient`, you can use following methods
### Methods

    
Submit a new analysis task for processing


```php
use Paysera\Test\TransferSurveillanceAssistantClient\Entity as Entities;

$analysisTaskInput = new Entities\AnalysisTaskInput();

$analysisTaskInput->setReferenceId($referenceId);
$analysisTaskInput->setReferenceType($referenceType);
    
$result = $transferSurveillanceAssistantClient->createAnalysisTask($analysisTaskInput);
```
---

I am not a real endpoint


```php

$transferSurveillanceAssistantClient->updateAnalysisTask();
```
---

