
## vendor-category-client

Provides methods to manipulate `CategoryClient` API.
It automatically authenticates all requests and maps required data structure for you.

#### Usage

This library provides `ClientFactory` class, which you should use to get the API client itself:

```php
use Paysera\Test\CategoryClient\ClientFactory;

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
use Paysera\Test\CategoryClient\Entity as Entities;

$categoryFilter = new Entities\CategoryFilter();

$categoryFilter->setParentId($parentId);
    
$result = $categoryClient->getCategories($categoryFilter);
```
---

Create category


```php
use Paysera\Test\CategoryClient\Entity as Entities;

$category = new Entities\Category();

$category->setId($id);
$category->setPhoto($photo);
$category->setAvatar($avatar);
$category->setParentId($parentId);
$category->setTitles($titles);
$category->setStatus($status);
    
$result = $categoryClient->createCategory($category);
```
---

    
Upload category


```php
use Paysera\Test\CategoryClient\Entity as Entities;

$file = new \Paysera\Component\RestClientCommon\Entity\File();

$file->setName($name);
$file->setContent($content);
$file->setMimeType($mimeType);
$file->setSize($size);
    
$categoryClient->uploadKeywords($file);
```
---


Standard SQL-style Result filtering


```php
use Paysera\Test\CategoryClient\Entity as Entities;

$filter = new \Paysera\Component\RestClientCommon\Entity\Filter();

$filter->setLimit($limit);
$filter->setOffset($offset);
$filter->setOrderBy($orderBy);
$filter->setOrderDirection($orderDirection);
    
$categoryClient->getKeywords($filter);
```
---

