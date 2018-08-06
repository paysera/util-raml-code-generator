# util-raml-code-generator [![Build Status](https://travis-ci.org/paysera/util-raml-code-generator.svg?branch=master)](https://travis-ci.org/paysera/util-raml-code-generator)

`util-raml-code-generator` generates code packages from specified RAML definition.
Currently this utility can:
* Automatically generate and release:
  * `PHP REST API client`
  * `Javascript REST API client`
* Generate `Symfony Api Bundle`

## Installation

 * Clone repository and run `composer install`

# Table of contents
1. [RAML structure](#raml-structure)
    1. [api.raml](#raml/category/api.raml)
    1. [types/category.raml](#raml/category/types/category.raml)
    1. [types/category-result.raml](#raml/category/types/category-result.raml)
    1. [traits/category-filter.raml](#raml/category/traits/category-filter.raml)
1. [Generate and publish clients](#generate-and-publish-clients)
    1. [config.json format](#config.json-format)
1. [Generate Javascript REST client](#generate-javascript-rest-client)
    1. [File tree](#javascript-client-file-tree)
    1. [src/entity/Category.js](#src/entity/category.js)
    1. [src/entity/CategoryFilter.js](#src/entity/categoryfilter.js)
    1. [src/entity/CategoryResult.js](#src/entity/categoryresult.js)
    1. [src/service/createClient.js](#src/service/createclient.js)
    1. [src/service/CategoryClient.js](#src/service/categoryclient.js)
1. [Generate PHP REST client](#generate-php-rest-client)
    1. [File tree](#php-client-file-tree)
    1. [src/CategoryClient.php](#src/categoryclient.php)
    1. [src/ClientFactory.php](#src/clientfactory.php)
    1. [src/Entity/Category.php](#src/entity/category.php)
    1. [src/Entity/CategoryFilter.php](#src/entity/categoryfilter.php)
    1. [src/Entity/CategoryResult.php](#src/entity/categoryresult.php)
1. [Generate Symfony Bundle](#generate-symfony-bundle)


## RAML structure

Lets have following `RAML` structure:

```
raml
└───category
    |   api.raml
    |
    ├───traits
    |       category-filter.raml
    |
    ├───types
    |       category.raml
    |       category-result.raml
```
With following contents:

#### raml/category/api.raml
```yaml
#%RAML 1.0
title: Category API
version: v1
baseUri: https://example.com/category/rest/v1
mediaType: application/json
protocols: [ HTTPS ]

uses:
  Paysera: https://raw.githubusercontent.com/paysera/lib-raml-common/master/rest.raml

types:
  Category: !include types/category.raml
  CategoryResult: !include types/category-result.raml

traits:
  CategoryFilter: !include traits/category-filter.raml

/categories:
  get:
    description: Get categories list
    is:
      - CategoryFilter
  post:
    description: Create category
    body:
      application/json:
        type: Category
    responses:
      200:
        body:
          application/json:
            type: CategoryResult
  /{id}:
    uriParameters:
      id:
        type: string
    put:
      description: Update category
      body:
        application/json:
          type: Category
      responses:
        200:
          body:
            application/json:
              type: Category
    delete:
      description: Delete category
    /enable:
      put:
        description: Enable category
        responses:
          200:
            body:
              application/json:
                type: Category
    /disable:
      put:
        description: Disable category
        responses:
          200:
            body:
              application/json:
                type: Category
```

#### raml/category/types/category.raml
```yaml
#%RAML 1.0 DataType
type: object
displayName: Category object
properties:
  id:
    type: string
    required: false
    description: Object id
  parent_id:
    type: string
    required: false
    description: Category parent id
  name:
    type: string
    required: true
    description: Category title
  status:
    type: string
    enum: ["active", "inactive"]
    required: false
    description: Category status
```

#### raml/category/traits/category-filter.raml
```yaml
#%RAML 1.0 Trait
usage: Used where Category filtering is provided
description: Category Result filtering
is:
  - Paysera.Filter
queryParameters:
  parent_id:
    displayName: parent_id
    type: string
    minLength: 1
    example: 123456
    required: false
```

#### raml/category/types/category-result.raml
```yaml
#%RAML 1.0 DataType
type: Paysera.Result
displayName: Category Result object
properties:
  items:
    required: true
    type: array
    items:
      type: Category
```

## Generate and publish clients

1. Run `bin/console release:clients {path_to_config}`.
    * `path_to_config` path to `config.json` file.
    
This command will
1. clone repository
1. generate clients from `raml`
1. update changelog
1. show you the difference between current and generated files
1. generate dist files for javascript
1. create a commit
1. push commit
1. create tag
    
#### config.json format 
```json
{
  "SomeApiName": {
    "raml_file": "path/to/api.raml",
    "clients": {
      "javascript": {
        "repository": "ssh://some.hostname.com/source/js-some-monorepo.git/packages/some-api-client",
        "library_name": "@vendor/some-api-client",
        "client_name": "SomeApiClient"
      },
      "php": {
          "repository": "ssh://some.hostname.com/source/some-api-client-dedicated-repo.git",
          "library_name": "vendor/lib-some-api-client",
          "namespace": "Vendor\\Client\\SomeApiClient"
      }
    }
  }
}
```

## Generate Javascript REST client

1. Run `bin/console js-generator:package {path_to_raml} {output_dir} {client_name} --library_name={library_name}`.
    * `path_to_raml` path to `raml` file.
    * `output_dir` directory where to put generated files.
    * `client_name` is the name of your main javascript client. 
    * `library_name` is optional name for generated library, i.e. `@paysera/some-api-client`
1. Check the dumped output to `{output_dir}` directory.


#### Javascript client file tree
In `output_dir` you should expect these files generated:
```
|   .babelrc
|   .eslintrc
|   .gitignore
|   package.json
|   README.md
|   webpack-config.js
|
└───demo
    |   app.js
    |   index.html
    src
    |   index.js
    |   angular.module.js
    |
    ├───entity
    |       Category.js
    |       CategoryFilter.js
    |       CategoryResult.js
    |
    ├───service
    |       CategoryClient.js
    |       createClient.js
```
With following contents of services and entities `src` directory:

#### src/entity/Category.js
```javascript
import { Entity } from '@paysera/http-client-common';

class Category extends Entity {
    constructor(data = {}) {
        super(data);
    }

    /**
     * @return {string}|null
     */
    getId() {
        return this.get('id');
    }

    /**
     * @param {string} id
     */
    setId(id) {
        this.set('id', id);
    }

    /**
     * @return {string}|null
     */
    getParentId() {
        return this.get('parent_id');
    }

    /**
     * @param {string} parentId
     */
    setParentId(parentId) {
        this.set('parent_id', parentId);
    }

    /**
     * @return {string}
     */
    getName() {
        return this.get('name');
    }

    /**
     * @param {string} name
     */
    setName(name) {
        this.set('name', name);
    }

    /**
     * @return {string}|null
     */
    getStatus() {
        return this.get('status');
    }

    /**
     * @param {string} status
     */
    setStatus(status) {
        this.set('status', status);
    }
}

export default Category;

```

#### src/entity/CategoryFilter.js
```javascript
import { Filter } from '@paysera/http-client-common';

class CategoryFilter extends Filter {
    /**
     * @return {string}|null
     */
    getParentId() {
        return this.get('parent_id');
    }

    /**
     * @param {string} parentId
     */
    setParentId(parentId) {
        this.set('parent_id', parentId);
    }
}

export default CategoryFilter;

```

#### src/entity/CategoryResult.js
```javascript
import Category from './Category';
import { Result } from '@paysera/http-client-common';

/* eslint class-methods-use-this: ["error", { "exceptMethods": ["createItem"] }] */
class CategoryResult extends Result {
    /**
     * @param {Array} data
     * @returns {Category}
     */
    createItem(data) {
        return new Category(data);
    }
}

export default CategoryResult;

```

#### src/service/createClient.js
```javascript
import { createClient } from '@paysera/http-client-common';
import CategoryClient from './CategoryClient';

/**
 * @param {string} baseURL
 * @param {[]|null} middleware
 * @param {object} options
 *
 * @returns {CategoryClient}
 */
/* eslint import/prefer-default-export: ["off"] */
export const createAClient = ({
    baseURL = 'https://example.com/category/rest/v1/',
    middleware = null,
    options = {}
}) => {
    const defaultUrlParameters = {};
    
    if (Object.prototype.hasOwnProperty.call(options, 'urlParameters')) {
        const { urlParameters } = options;
        for (let [key, value] of Object.entries(defaultUrlParameters)) {
            if (!Object.prototype.hasOwnProperty.call(urlParameters, key)) {
                urlParameters[key] = value;
            }
        }
        options.urlParameters = urlParameters;
    }

    return new CategoryClient(
        createClient({
            baseURL,
            middleware,
            options
        })
    )
};

```

#### src/service/CategoryClient.js
```javascript
import { createRequest, ClientWrapper } from '@paysera/http-client-common';

import Category from '../entity/Category';
import CategoryFilter from '../entity/CategoryFilter';
import CategoryResult from '../entity/CategoryResult';

class CategoryClient {
    /**
     * @param {ClientWrapper} client
     */
    constructor(client) {
        this.client = client;
    }

    /**
     * Enable category
     * PUT /categories/{id}/enable
     *
     * @param {string} id
     * @return {Promise.<Category>}
     */
    enableCategory(id) {
        const request = createRequest(
            'PUT',
            `categories/${encodeURIComponent(id)}/enable`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new Category(data));
    }

    /**
     * Disable category
     * PUT /categories/{id}/disable
     *
     * @param {string} id
     * @return {Promise.<Category>}
     */
    disableCategory(id) {
        const request = createRequest(
            'PUT',
            `categories/${encodeURIComponent(id)}/disable`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => new Category(data));
    }

    /**
     * Update category
     * PUT /categories/{id}
     *
     * @param {string} id
     * @param {Category} category
     * @return {Promise.<Category>}
     */
    updateCategory(id, category) {
        const request = createRequest(
            'PUT',
            `categories/${encodeURIComponent(id)}`,
            category,
        );

        return this.client
            .performRequest(request)
            .then(data => new Category(data));
    }
    /**
     * Delete category
     * DELETE /categories/{id}
     *
     * @param {string} id
     * @return {Promise.<null>}
     */
    deleteCategory(id) {
        const request = createRequest(
            'DELETE',
            `categories/${encodeURIComponent(id)}`,
            null,
        );

        return this.client
            .performRequest(request)
            .then(data => null);
    }

    /**
     * Standard SQL-style Result filtering
     * GET /categories
     *
     * @param {CategoryFilter} categoryFilter
     * @return {Promise.<null>}
     */
    getCategories(categoryFilter) {
        const request = createRequest(
            'GET',
            `categories`,
            categoryFilter,
        );

        return this.client
            .performRequest(request)
            .then(data => null);
    }
    /**
     * Create category
     * POST /categories
     *
     * @param {Category} category
     * @return {Promise.<CategoryResult>}
     */
    createCategory(category) {
        const request = createRequest(
            'POST',
            `categories`,
            category,
        );

        return this.client
            .performRequest(request)
            .then(data => new CategoryResult(data, 'items'));
    }

}

export default AClient;

```

## Generate PHP REST client

1. Run `bin/console php-generator:rest-client {path_to_raml} {output_dir} {namespace} --library_name={library_name}`.
    * `path_to_raml` path to `raml` file.
    * `output_dir` directory where to put generated files.
    * `namespace` is the namespace of Client. 
    * `library_name` is optional name for generated library, i.e. `paysera/lib-some-api-client`
1. Check the dumped output to `{output_dir}` directory.

#### PHP Client file tree
In `output_dir` you should expect these files generated:
```
|   composer.json
|   README.md
|
└───src
    |   CategoryClient.php
    |   ClientFactory.php
    |
    ├───Entity
    |       Category.php
    |       CategoryFilter.php
    |       CategoryResult.php

```
With following contents of `src` directory:

#### src/CategoryClient.php
```php
<?php

namespace Paysera\Test\CategoryClient;

use Paysera\Test\CategoryClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class CategoryClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new CategoryClient($this->apiClient->withOptions($options));
    }

    /**
     * Enable category
     * PUT /categories/{id}/enable
     *
     * @param string $id
     * @return Entities\Category
     */
    public function enableCategory($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('categories/%s/enable', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Category($data);
    }

    /**
     * Disable category
     * PUT /categories/{id}/disable
     *
     * @param string $id
     * @return Entities\Category
     */
    public function disableCategory($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('categories/%s/disable', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Category($data);
    }

    /**
     * Update category
     * PUT /categories/{id}
     *
     * @param string $id
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function updateCategory($id, Entities\Category $category)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('categories/%s', urlencode($id)),
            $category
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Category($data);
    }

    /**
     * Delete category
     * DELETE /categories/{id}
     *
     * @param string $id
     * @return null
     */
    public function deleteCategory($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_DELETE,
            sprintf('categories/%s', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }

    /**
     * Standard SQL-style Result filtering
     * GET /categories
     *
     * @param Entities\CategoryFilter $categoryFilter
     * @return null
     */
    public function getCategories(Entities\CategoryFilter $categoryFilter)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'categories',
            $categoryFilter
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }

    /**
     * Create category
     * POST /categories
     *
     * @param Entities\Category $category
     * @return Entities\CategoryResult
     */
    public function createCategory(Entities\Category $category)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'categories',
            $category
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\CategoryResult($data, 'items');
    }
}

```

#### src/ClientFactory.php
```php
<?php

namespace Paysera\Test\CategoryClient;

use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class ClientFactory extends ClientFactoryAbstract
{
    const DEFAULT_BASE_URL = 'https://example.com/category/rest/v1/';

    private $apiClient;

    public function __construct($options)
    {
        if ($options instanceof ApiClient) {
            $this->apiClient = $options;
            return;
        }

        $defaultUrlParameters = [];
        
        $options['url_parameters'] = $this->resolveDefaultUrlParameters($defaultUrlParameters, $options);
        $this->apiClient = $this->createApiClient($options);
    }

    public function getAClient()
    {
        return new CategoryClient($this->apiClient);
    }

    private function resolveDefaultUrlParameters(array $defaults, array $options)
    {
        $params = [];
        if (isset($options['url_parameters'])) {
            $params = $options['url_parameters'];
        }

        return $params + $defaults;
    }
}

```

#### src/Entity/Category.php
```php
<?php

namespace Paysera\Test\CategoryClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Category extends Entity
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string|null
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
     * @return string|null
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
     * @return string|null
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

#### src/Entity/CategoryFilter.php
```php
<?php

namespace Paysera\Test\CategoryClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Filter;

class CategoryFilter extends Filter
{
    /**
     * @return string|null
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

#### src/Entity/CategoryResult.php
```php
<?php

namespace Paysera\Test\CategoryClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Result;

class CategoryResult extends Result
{
    protected function createItem(array $data)
    {
        return new Category($data);
    }
}

```

## Generate Symfony Bundle

1. Run `bin/console php-generator:symfony-bundle {path_to_raml} {output_dir} {namespace}`.
    * `path_to_raml` path to `raml` file.
    * `output_dir` directory where to put generated files.
    * `namespace` is the namespace of your Symfony Bundle. 
1. Check the dumped output to `{output_dir}` directory.

In `output_dir` you should expect these files generated:
```
|   CategoryPermissions.php
|   VendorCategoryApiBundle.php
|
└───Controller
    |   CategoryApiController.php
    |
    DependencyInjection
    |   Configuration.php
    |   VendorCategoryApiExtension.php
    |
    Entity
    |   Category.php
    |   CategoryFilter.php
    |
    Normalizer
    |   CategoryNormalizer.php
    |   CategoryFilterNormalizer.php
    |
    Repository
    |   CategoryRepository.php
    |
    Service
    |   CategoryManager.php
    |
    Voter
    |   CategoryScopeVoter.php
    |
    Resources
    |
    ├───config
    |       routing.xml
    |       services.xml
    |       
    ├───────services
    |           api.xml
    |           controllers.xml
    |           normalizers.xml
    |           repositories.xml
    |           services.xml
    |
    ├───────routing
    |           rest_v1.xml
    |
    ├───────doctrine
    |           Category.orm.xml

```
With following contents:



`CategoryPermissions.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle;

final class CategoryPermissions
{
    const GET_CATEGORIES = 'get_categories';
    const CREATE_CATEGORY = 'create_category';
    const UPDATE_CATEGORY = 'update_category';
    const DELETE_CATEGORY = 'delete_category';
    const ENABLE_CATEGORY = 'enable_category';
    const DISABLE_CATEGORY = 'disable_category';
    
}

```


`VendorCategoryApiBundle.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class VendorCategoryApiBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
    }
}

```


`Controller/CategoryApiController.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle\Controller;

use Vendor\Test\CategoryApiBundle\Entity as Entities;
use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\CategoryApiBundle\Service\CategoryManager;
use Vendor\Test\CategoryApiBundle\CategoryPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class CategoryApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $categoryManager;
    
    public function __construct(
        CategoryManager $categoryManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->categoryManager = $categoryManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Enable category
     * PUT /categories/{id}/enable
     *
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function enableCategory(Entities\Category $category)
    {
        $this->authorizationChecker->check(CategoryPermissions::ENABLE_CATEGORY);
        $result = $this->categoryManager->enableCategory($category);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Disable category
     * PUT /categories/{id}/disable
     *
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function disableCategory(Entities\Category $category)
    {
        $this->authorizationChecker->check(CategoryPermissions::DISABLE_CATEGORY);
        $result = $this->categoryManager->disableCategory($category);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Update category
     * PUT /categories/{id}
     *
     * @param Entities\Category $originalCategory
     * @param Entities\Category $updatedCategory
     * @return Entities\Category
     */
    public function updateCategory(Entities\Category $originalCategory, Entities\Category $updatedCategory)
    {
        $this->authorizationChecker->check(CategoryPermissions::UPDATE_CATEGORY);
        $result = $this->categoryManager->updateCategory($originalCategory, $updatedCategory);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Delete category
     * DELETE /categories/{id}
     *
     * @param Entities\Category $category
     * @return null
     */
    public function deleteCategory(Entities\Category $category)
    {
        $this->authorizationChecker->check(CategoryPermissions::DELETE_CATEGORY);
        $this->categoryManager->deleteCategory($category);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Standard SQL-style Result filtering
     * GET /categories
     *
     * @param Entities\CategoryFilter $categoryFilter
     * @return null
     */
    public function getCategories(Entities\CategoryFilter $categoryFilter)
    {
        $this->authorizationChecker->check(CategoryPermissions::GET_CATEGORIES);
        return $this->categoryManager->getCategories($categoryFilter);
    }
    /**
     * Create category
     * POST /categories
     *
     * @param Entities\Category $category
     * @return Result|Entities\Category[]
     */
    public function createCategory(Entities\Category $category)
    {
        $this->authorizationChecker->check(CategoryPermissions::CREATE_CATEGORY);
        $result = $this->categoryManager->createCategory($category);
        $this->entityManager->flush();
        return $result;
    }
}

```


`DependencyInjection/Configuration.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('vendor_category_api');

        return $treeBuilder;
    }
}

```


`DependencyInjection/VendorCategoryApiExtension.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class VendorCategoryApiExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
}

```


`Entity/Category.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle\Entity;

class Category
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    private $id;
    private $parentId;
    private $name;
    private $status;

    public function __construct()
    {
                    
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string|null
     */
    public function getParentId()
    {
        return $this->parentId;
    }
    /**
     * @param string $parentId
     * @return $this
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        return $this;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}

```

`Entity/CategoryFilter.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle\Entity;

use Paysera\Component\Serializer\Entity\Filter;

class CategoryFilter extends Filter
{
    private $parentId;

    /**
     * @return string|null
     */
    public function getParentId()
    {
        return $this->parentId;
    }
    /**
     * @param string $parentId
     * @return $this
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        return $this;
    }
}


```

`Normalizer/CategoryNormalizer.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\CategoryApiBundle\Entity\Category;

class CategoryNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Category
     */
    public function mapToEntity($data)
    {
        $entity = new Category();

        if (isset($data['parent_id'])) {
            $entity->setParentId($data['parent_id']);
        }
        if (isset($data['name'])) {
            $entity->setName($data['name']);
        }
        if (isset($data['status'])) {
            $entity->setStatus($data['status']);
        }
        
        return $entity;
    }

    /**
     * @param Category $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'parent_id' => $entity->getParentId(),
            'name' => $entity->getName(),
            'status' => $entity->getStatus(),
            
        ];
    }
}

```

`Normalizer/CategoryFilterNormalizer.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\FilterNormalizer;
use Vendor\Test\CategoryApiBundle\Entity\CategoryFilter;

class CategoryFilterNormalizer extends FilterNormalizer
{
    /**
     * @param array $data
     *
     * @return CategoryFilter
     */
    public function mapToEntity($data)
    {
        $entity = new CategoryFilter();
        $this->mapBaseKeys($data, $entity);

        if (isset($data['parent_id'])) {
            $entity->setParentId($data['parent_id']);
        }
        
        return $entity;
    }

    /**
     * @param CategoryFilter $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        $data = parent::mapFromEntity($entity);
        return array_merge(
            $data,
            [
                'parent_id' => $entity->getParentId(),
                
            ]
        );
        
    }
}

```

`Repository/CategoryRepository.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
}

```

`Service/CategoryManager.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle\Service;

use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\CategoryApiBundle\Entity as Entities;
use Vendor\Test\CategoryApiBundle\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;

class CategoryManager
{
    private $categoryRepository;
    private $entityManager;

    public function __construct(
        CategoryRepository $categoryRepository,
        EntityManager $entityManager
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function enableCategory(Entities\Category $category)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function disableCategory(Entities\Category $category)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Category $category
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function updateCategory(Entities\Category $originalCategory, Entities\Category $updatedCategory)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Category $category
     * @return null
     */
    public function deleteCategory(Entities\Category $category)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\CategoryFilter $categoryFilter
     * @return null
     */
    public function getCategories(Entities\CategoryFilter $categoryFilter)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Category $category
     * @return Result|Entities\Category[]
     */
    public function createCategory(Entities\Category $category)
    {
        //TODO: generated_code
    }
}

```


`Voter/CategoryScopeVoter.php`
```php
<?php

namespace Vendor\Test\CategoryApiBundle\Voter;

use Vendor\Test\CategoryApiBundle\CategoryPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class CategoryScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            CategoryPermissions::GET_CATEGORIES => [
                // TODO: generated_code
            ],
            CategoryPermissions::CREATE_CATEGORY => [
                // TODO: generated_code
            ],
            CategoryPermissions::UPDATE_CATEGORY => [
                // TODO: generated_code
            ],
            CategoryPermissions::DELETE_CATEGORY => [
                // TODO: generated_code
            ],
            CategoryPermissions::ENABLE_CATEGORY => [
                // TODO: generated_code
            ],
            CategoryPermissions::DISABLE_CATEGORY => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}

```
