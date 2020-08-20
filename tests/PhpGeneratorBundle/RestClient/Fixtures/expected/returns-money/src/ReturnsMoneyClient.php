<?php

namespace Paysera\Test\ReturnsMoneyClient;

use Paysera\Test\ReturnsMoneyClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;
use Evp\Component\Money\Money;

class ReturnsMoneyClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new ReturnsMoneyClient($this->apiClient->withOptions($options));
    }

    /**
     * GET /accounts/{accountNumber}/balance/reserved
     *
     * @param string $accountNumber
     * @return Money
     */
    public function getAccountBalanceReserved($accountNumber)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('accounts/%s/balance/reserved', rawurlencode($accountNumber)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Money($data['amount'], $data['currency']);
    }
}
