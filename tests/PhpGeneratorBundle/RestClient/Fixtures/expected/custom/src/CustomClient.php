<?php

namespace Paysera\Test\CustomClient;

use Paysera\Test\CustomClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class CustomClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new CustomClient($this->apiClient->withOptions($options));
    }

    /**
     * GET /something
     *
     * @return null
     */
    public function customNameForMethod()
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'something',
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
}
