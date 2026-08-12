<?php

namespace Paysera\Test\NullableUnionClient;

use Paysera\Test\NullableUnionClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class NullableUnionClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new NullableUnionClient($this->apiClient->withOptions($options));
    }

    /**
     * Create order
     * POST /orders
     *
     * @param Entities\Order $order
     * @return Entities\Order
     */
    public function createOrder(Entities\Order $order)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'orders',
            $order
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Order($data);
    }
}
