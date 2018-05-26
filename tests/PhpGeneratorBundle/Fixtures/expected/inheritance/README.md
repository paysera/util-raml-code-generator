
## vendor-inheritance-client

Provides methods to manipulate `InheritanceClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\InheritanceClient\ClientFactory;

$clientFactory = ClientFactory::create([
    'base_url' => 'https://example.com/user/rest/v1', // optional, in case you need a custom one.
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

$inheritanceClient = $clientFactory->getInheritanceClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `InheritanceClient`, you can use following methods
### Methods

    
User Natural Filter


```php
use Paysera\Test\InheritanceClient\Entity as Entities;

$userNaturalFilter = new Entities\UserNaturalFilter();

$userNaturalFilter->setFirstName($firstName);
$userNaturalFilter->setLastName($lastName);
    
$result = $inheritanceClient->getUserNatural($userNaturalFilter);
```
---

Creates Natural user


```php
use Paysera\Test\InheritanceClient\Entity as Entities;

$userNatural = new Entities\UserNatural();

$userNatural->setName($name);
$userNatural->setSurname($surname);
    
$result = $inheritanceClient->createNaturalUser($userNatural);
```
---


Standard SQL-style Result filtering


```php
use Paysera\Test\InheritanceClient\Entity as Entities;

$userLegalFilter = new Entities\UserLegalFilter();

$userLegalFilter->setCompanyName($companyName);
    
$result = $inheritanceClient->getUserLegal($userLegalFilter);
```
---

Creates Legal user


```php
use Paysera\Test\InheritanceClient\Entity as Entities;

$userLegal = new Entities\UserLegal();

$userLegal->setCompanyName($companyName);
$userLegal->setCompanyCode($companyCode);
$userLegal->setVatCode($vatCode);
    
$result = $inheritanceClient->createLegalUser($userLegal);
```
---


Standard SQL-style Result filtering


```php
use Paysera\Test\InheritanceClient\Entity as Entities;

$userFilter = new Entities\UserFilter();

$userFilter->setUserId($userId);
$userFilter->setUserType($userType);
    
$result = $inheritanceClient->getUsers($userFilter);
```
---

Creates Basic user


```php
use Paysera\Test\InheritanceClient\Entity as Entities;

$userBasic = new Entities\UserBasic();

$userBasic->setType($type);
    
$result = $inheritanceClient->createUser($userBasic);
```
---

