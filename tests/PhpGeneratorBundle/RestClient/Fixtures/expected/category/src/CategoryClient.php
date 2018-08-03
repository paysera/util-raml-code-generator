<?php

namespace Paysera\Test\CategoryClient;

use Paysera\Test\CategoryClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;
use Paysera\Component\RestClientCommon\Entity\Filter;

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
     * @return Entities\Category
     */
    public function updateCategory($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('categories/%s', urlencode($id)),
            null
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
     * @return Entities\Category[]
     */
    public function getCategories(Entities\CategoryFilter $categoryFilter)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'categories',
            $categoryFilter
        );
        $data = $this->apiClient->makeRequest($request);

        return array_map(function ($item) { return new Entities\Category($item); }, $data);
    }

    /**
     * Create category
     * POST /categories
     *
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function createCategory(Entities\Category $category)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'categories',
            $category
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Category($data);
    }

    /**
     * Standard SQL-style Result filtering
     * GET /keywords
     *
     * @param Filter $filter
     * @return null
     */
    public function getKeywords(Filter $filter)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'keywords',
            $filter
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
}
