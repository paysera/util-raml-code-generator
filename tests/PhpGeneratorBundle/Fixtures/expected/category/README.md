
## vendor-category-client

Provides methods to manipulate `Category` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\TestClient\ClientFactory;

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

$categoryClient = $clientFactory->getCategoryClient();
```

Please use only one authentication mechanism, provided by `Vendor`.

Now, that you have instance of `CategoryClient`, you can use following methods
### Methods

    
Enable category


```php

$result = $categoryClient->enableCategory($id);
```
---


Disable category


```php

$result = $categoryClient->disableCategory($id);
```
---


Update category


```php

$result = $categoryClient->updateCategory($id);
```
---

Delete category


```php

$categoryClient->deleteCategory($id);
```
---


Standard SQL-style Result filtering


```php
use Paysera\Test\TestClient\Entity as Entities;

$categoryFilter = new Entities\CategoryFilter();

$categoryFilter->setParentId($parentId);
    
$categoryClient->getCategories($categoryFilter);
```
---

Create category


```php
use Paysera\Test\TestClient\Entity as Entities;

$category = new Entities\Category();

$category->setId($id);
$category->setParentId($parentId);
$category->setTitles($titles);
$category->setStatus($status);
    
$result = $categoryClient->createCategory($category);
```
---

