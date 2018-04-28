
## vendor-transfer-surveillance-client

Provides methods to manipulate `TransferSurveillance` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\TestClient\ClientFactory;

$clientFactory = ClientFactory::create([
    'base_url' => 'http://example.com/transfer-surveillance/rest/v1/', // optional, in case you need a custom one.
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

$transferSurveillanceClient = $clientFactory->getTransferSurveillanceClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `TransferSurveillanceClient`, you can use following methods
### Methods

    
Mark Inspection as accepted. Allow transfer to complete


```php
use Paysera\Test\TestClient\Entity as Entities;

$review = new Entities\Review();

$review->setReviewerUserId($reviewerUserId);
$review->setComment($comment);
$review->setInternalComment($internalComment);
    
$transferSurveillanceClient->acceptTransferInspection($transferId, $review);
```
---


Mark Inspection as cancelled/rejected. Do not allow the transfer to complete


```php
use Paysera\Test\TestClient\Entity as Entities;

$review = new Entities\Review();

$review->setReviewerUserId($reviewerUserId);
$review->setComment($comment);
$review->setInternalComment($internalComment);
    
$transferSurveillanceClient->cancelTransferInspection($transferId, $review);
```
---


Mark Inspection as audited.


```php
use Paysera\Test\TestClient\Entity as Entities;

$review = new Entities\Review();

$review->setReviewerUserId($reviewerUserId);
$review->setComment($comment);
$review->setInternalComment($internalComment);
    
$transferSurveillanceClient->auditTransferInspection($transferId, $review);
```
---


Mark Inspection as need additional info from user about the transfer.


```php
use Paysera\Test\TestClient\Entity as Entities;

$review = new Entities\Review();

$review->setReviewerUserId($reviewerUserId);
$review->setComment($comment);
$review->setInternalComment($internalComment);
    
$transferSurveillanceClient->requestTransferInspectionUserInfo($transferId, $review);
```
---


Mark Inspection as received additional info from user about the transfer.


```php
use Paysera\Test\TestClient\Entity as Entities;

$review = new Entities\Review();

$review->setReviewerUserId($reviewerUserId);
$review->setComment($comment);
$review->setInternalComment($internalComment);
    
$transferSurveillanceClient->receiveTransferInspectionUserInfo($transferId, $review);
```
---




    
Get Transfer Surveillance Matchers


```php

$result = $transferSurveillanceClient->getMatchers();
```
---

    
Delete MatchCriteria


```php

$transferSurveillanceClient->deleteCriterion($id);
```
---

Get MatchCriterion


```php

$result = $transferSurveillanceClient->getCriterion($id);
```
---

Update MatchCriteria


```php
use Paysera\Test\TestClient\Entity as Entities;

$matchCriteria = new Entities\MatchCriteria();

$matchCriteria->setId($id);
$matchCriteria->setMatcherIdentifier($matcherIdentifier);
$matchCriteria->setQuery($query);
$matchCriteria->setDescription($description);
$matchCriteria->setParameters($parameters);
    
$result = $transferSurveillanceClient->updateCriterion($id, $matchCriteria);
```
---


Get MatchCriterias


```php

$result = $transferSurveillanceClient->getCriterias();
```
---

Create MatchCriteria


```php
use Paysera\Test\TestClient\Entity as Entities;

$matchCriteria = new Entities\MatchCriteria();

$matchCriteria->setId($id);
$matchCriteria->setMatcherIdentifier($matcherIdentifier);
$matchCriteria->setQuery($query);
$matchCriteria->setDescription($description);
$matchCriteria->setParameters($parameters);
    
$result = $transferSurveillanceClient->createCriterion($matchCriteria);
```
---

    
Enable rule


```php

$transferSurveillanceClient->enableRule($id);
```
---


Disable rule


```php

$transferSurveillanceClient->disableRule($id);
```
---


Get a single whitelist


```php

$result = $transferSurveillanceClient->getRuleWhitelistProfileLists($id, $whitelistId);
```
---

Update whitelist


```php
use Paysera\Test\TestClient\Entity as Entities;

$whitelist = new Entities\Whitelist();

$whitelist->setId($id);
$whitelist->setPayerCovenanteeId($payerCovenanteeId);
$whitelist->setPayerAccountIdentifier($payerAccountIdentifier);
$whitelist->setBeneficiaryCovenanteeId($beneficiaryCovenanteeId);
$whitelist->setBeneficiaryAccountIdentifier($beneficiaryAccountIdentifier);
$whitelist->setMaxAmount($maxAmount);
$whitelist->setProfiles($profiles);
    
$result = $transferSurveillanceClient->updateRuleWhitelistProfileList($id, $whitelistId, $whitelist);
```
---


Get a single whitelist


```php

$result = $transferSurveillanceClient->getRuleWhitelist($id, $whitelistId);
```
---

Update whitelist


```php
use Paysera\Test\TestClient\Entity as Entities;

$whitelist = new Entities\Whitelist();

$whitelist->setId($id);
$whitelist->setPayerCovenanteeId($payerCovenanteeId);
$whitelist->setPayerAccountIdentifier($payerAccountIdentifier);
$whitelist->setBeneficiaryCovenanteeId($beneficiaryCovenanteeId);
$whitelist->setBeneficiaryAccountIdentifier($beneficiaryAccountIdentifier);
$whitelist->setMaxAmount($maxAmount);
$whitelist->setProfiles($profiles);
    
$result = $transferSurveillanceClient->updateRuleWhitelist($id, $whitelistId, $whitelist);
```
---

Delete a whitelist


```php

$transferSurveillanceClient->deleteRuleWhitelist($id, $whitelistId);
```
---


Get all active whitelists for this rule


```php

$result = $transferSurveillanceClient->getRuleWhitelists($id);
```
---

Add whitelist to a rule


```php
use Paysera\Test\TestClient\Entity as Entities;

$whitelist = new Entities\Whitelist();

$whitelist->setId($id);
$whitelist->setPayerCovenanteeId($payerCovenanteeId);
$whitelist->setPayerAccountIdentifier($payerAccountIdentifier);
$whitelist->setBeneficiaryCovenanteeId($beneficiaryCovenanteeId);
$whitelist->setBeneficiaryAccountIdentifier($beneficiaryAccountIdentifier);
$whitelist->setMaxAmount($maxAmount);
$whitelist->setProfiles($profiles);
    
$result = $transferSurveillanceClient->createRuleWhitelist($id, $whitelist);
```
---


Get a rule


```php

$result = $transferSurveillanceClient->getRule($id);
```
---

Update rule


```php
use Paysera\Test\TestClient\Entity as Entities;

$rule = new Entities\Rule();

$rule->setId($id);
$rule->setMatcherIdentifier($matcherIdentifier);
$rule->setTitle($title);
$rule->setAction($action);
$rule->setType($type);
$rule->setStatus($status);
$rule->setAmlDetailsNeeded($amlDetailsNeeded);
$rule->setRelatedBankAccountsAllowed($relatedBankAccountsAllowed);
$rule->setDescription($description);
$rule->setInformPrevention($informPrevention);
    
$result = $transferSurveillanceClient->updateRule($id, $rule);
```
---

Delete a rule


```php

$transferSurveillanceClient->deleteRule($id);
```
---


Standard SQL-style Result filtering


```php
use Paysera\Test\TestClient\Entity as Entities;

$ruleFilter = new Entities\RuleFilter();

$ruleFilter->setOrderBy($orderBy);
    
$result = $transferSurveillanceClient->getRules($ruleFilter);
```
---

Create a rule


```php
use Paysera\Test\TestClient\Entity as Entities;

$rule = new Entities\Rule();

$rule->setId($id);
$rule->setMatcherIdentifier($matcherIdentifier);
$rule->setTitle($title);
$rule->setAction($action);
$rule->setType($type);
$rule->setStatus($status);
$rule->setAmlDetailsNeeded($amlDetailsNeeded);
$rule->setRelatedBankAccountsAllowed($relatedBankAccountsAllowed);
$rule->setDescription($description);
$rule->setInformPrevention($informPrevention);
    
$result = $transferSurveillanceClient->createRule($rule);
```
---

