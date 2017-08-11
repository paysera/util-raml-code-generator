##### Generated directory structure:
```
generated
└───category
    |   composer.json
    └─--src
        |   CategoryClient.php
        |   ClientFactory.php
        └───Entity
        |       Category.php
        |       CategoryFilter.php
```

`generated/category/src/CategoryClient.php`

```php
<?php

namespace Paysera\Client\CategoryClient;

use Paysera\Client\CategoryClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class CategoryClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * PUT /categories/{id}/enable
     *
     * @param string $id
     * @return Entities\Category
     */
    public function enableCategory($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('/categories/%s/enable', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Category($data);
    }

    /**
     * PUT /categories/{id}/disable
     *
     * @param string $id
     * @return Entities\Category
     */
    public function disableCategory($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('/categories/%s/disable', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Category($data);
    }

    /**
     * PUT /categories/{id}
     *
     * @param string $id
     * @return Entities\Category
     */
    public function updateCategory($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('/categories/%s', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Category($data);
    }
    /**
     * DELETE /categories/{id}
     *
     * @param string $id
     * @return null
     */
    public function deleteCategory($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_DELETE,
            sprintf('/categories/%s', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }

    /**
     * GET /categories
     *
     * @param Entities\CategoryFilter $categoryFilter
     * @return null
     */
    public function getCategories(Entities\CategoryFilter $categoryFilter)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('/categories'),
            $categoryFilter
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * POST /categories
     *
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function createCategory(Entities\Category $category)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            sprintf('/categories'),
            $category
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Category($data);
    }

}
```

`generated/category/src/ClientFactory.php`

```php
<?php

namespace Paysera\Client\CategoryClient;

use Paysera\Component\RestClientCommon\Client\ApiClient;
use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;

class ClientFactory extends ClientFactoryAbstract
{
    protected static $baseUrl = 'https://example.com/category/rest/v1/';
    protected static $oauthBaseUrl = 'https://example.com/oauth/v1/';

    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getCategoryClient()
    {
        return new CategoryClient($this->apiClient);
    }
}
```

`generated/category/src/Entity/Category.php`

```php
<?php

namespace Paysera\Client\CategoryClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Category extends Entity
{
    /**
     * @return string
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
    * @param string $id
    * @return $this
    */
    public function setId($id)
    {
        $this->set('id', $id);
        return $this;
    }

    /**
     * @return string
     */
    public function getParentId()
    {
        return $this->get('parent_id');
    }

    /**
    * @param string $parentId
    * @return $this
    */
    public function setParentId($parentId)
    {
        $this->set('parent_id', $parentId);
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
    * @param string $name
    * @return $this
    */
    public function setName($name)
    {
        $this->set('name', $name);
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
    * @param string $status
    * @return $this
    */
    public function setStatus($status)
    {
        $this->set('status', $status);
        return $this;
    }

}
```

`generated/category/src/Entity/CategoryFilter.php`

```php
<?php

namespace Paysera\Client\CategoryClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Filter;

class CategoryFilter extends Filter
{
    /**
     * @return string
     */
    public function getParentId()
    {
        return $this->get('parent_id');
    }

    /**
    * @param string $parentId
    * @return $this
    */
    public function setParentId($parentId)
    {
        $this->set('parent_id', $parentId);
        return $this;
    }

}
```

`generated/category/composer.json`

```json
{
    "name": "paysera/lib-category-client",
    "description": "Category Client",
    "autoload": {
        "psr-4": {
            "Paysera\\Client\\CategoryClient\\": "src"
        }
    },
    "require": {
        "php": ">=5.5",
        "paysera/lib-rest-client-common": "^1.0",
        "fig/http-message-util": "^1.0"
    },
    "minimum-stability": "stable"
}
```
