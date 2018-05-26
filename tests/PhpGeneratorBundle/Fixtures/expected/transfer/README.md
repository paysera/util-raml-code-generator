
## vendor-transfer-client

Provides methods to manipulate `TransferClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\TransferClient\ClientFactory;

$clientFactory = ClientFactory::create([
    'base_url' => 'https://my-api.example.com/rest/v1', // optional, in case you need a custom one.
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

$transferClient = $clientFactory->getTransferClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `TransferClient`, you can use following methods
### Methods

    
Sign the transfer, even if no funds available.


```php
use Paysera\Test\TransferClient\Entity as Entities;

$transferRegistrationParameters = new Entities\TransferRegistrationParameters();

$transferRegistrationParameters->setConvertCurrency($convertCurrency);
    
$result = $transferClient->signTransfer($id, $transferRegistrationParameters);
```
---


Sign and reserve money for transfer. Returns error if no funds available.


```php
use Paysera\Test\TransferClient\Entity as Entities;

$transferRegistrationParameters = new Entities\TransferRegistrationParameters();

$transferRegistrationParameters->setConvertCurrency($convertCurrency);
    
$result = $transferClient->reserveTransfer($id, $transferRegistrationParameters);
```
---


Provide password for Transfer. Available only for internal transfers.


```php
use Paysera\Test\TransferClient\Entity as Entities;

$transferPassword = new Entities\TransferPassword();

$transferPassword->setPassword($password);
    
$result = $transferClient->provideTransferPassword($id, $transferPassword);
```
---


Freeze transfer. Available only for `reserved` transfers. Same as completing transfer but beneficiary cannot spend funds - they are reserved. Revoking transfer is possible after freezing.


```php

$result = $transferClient->freezeTransfer($id);
```
---


Complete transfer. Available for `reserved` and `freezed` transfers.


```php

$result = $transferClient->completeTransfer($id);
```
---


Make transfer visible in frontend for signing. If currency convert operations are related to transfer, they are done when transfer becomes `reserved`. If there are expectations in currency convert requests, transfer becomes `failed` together with related conversion request(s) if those expectations fails.


```php
use Paysera\Test\TransferClient\Entity as Entities;

$transferRegistrationParameters = new Entities\TransferRegistrationParameters();

$transferRegistrationParameters->setConvertCurrency($convertCurrency);
    
$result = $transferClient->registerTransfer($id, $transferRegistrationParameters);
```
---


Get transfer.


```php

$result = $transferClient->getTransfer($id);
```
---

Revoke transfer.


```php

$result = $transferClient->deleteTransfer($id);
```
---


Create transfer in the system. Created transfer is invisible and will be deleted if no more actions are performed.



```php
use Paysera\Test\TransferClient\Entity as Entities;

$transferInput = new Entities\TransferInput();

$transferInput->setAmount($amount);
$transferInput->setBeneficiary($beneficiary);
$transferInput->setPayer($payer);
$transferInput->setFinalBeneficiary($finalBeneficiary);
$transferInput->setPerformAt($performAt);
$transferInput->setChargeType($chargeType);
$transferInput->setUrgency($urgency);
$transferInput->setNotifications($notifications);
$transferInput->setPurpose($purpose);
$transferInput->setPassword($password);
$transferInput->setCancelable($cancelable);
$transferInput->setAutoCurrencyConvert($autoCurrencyConvert);
$transferInput->setAutoChargeRelatedCard($autoChargeRelatedCard);
$transferInput->setReserveUntil($reserveUntil);
    
$result = $transferClient->createTransfer($transferInput);
```
---

    
Reserve all transfers in a transaction. Possibly revoke other given transfers in same transaction. Possibly make currency convertions in in same transaction.


```php
use Paysera\Test\TransferClient\Entity as Entities;

$transfersBatch = new Entities\TransfersBatch();

$transfersBatch->setRevokedTransfers($revokedTransfers);
$transfersBatch->setReservedTransfers($reservedTransfers);
$transfersBatch->setConvertCurrency($convertCurrency);
    
$result = $transferClient->reserveTransfers($transfersBatch);
```
---


Get list of transfers by filter


```php
use Paysera\Test\TransferClient\Entity as Entities;

$transfersFilter = new Entities\TransfersFilter();

$transfersFilter->setCreatedDateFrom($createdDateFrom);
$transfersFilter->setCreatedDateTo($createdDateTo);
$transfersFilter->setCreditAccountNumber($creditAccountNumber);
$transfersFilter->setDebitAccountNumber($debitAccountNumber);
$transfersFilter->setStatuses($statuses);
    
$result = $transferClient->getTransfers($transfersFilter);
```
---

