<?php

namespace Paysera\Test\TestClient;

use Paysera\Test\TestClient\Entity as Entities;
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
}
