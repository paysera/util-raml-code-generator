<?php

namespace Paysera\Test\MoneyCollectionClient;

use Paysera\Test\MoneyCollectionClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class MoneyCollectionClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new MoneyCollectionClient($this->apiClient->withOptions($options));
    }

    /**
     * GET /accounts/{accountNumber}/balances
     *
     * @param string $accountNumber
     * @return Entities\Balance
     */
    public function getAccountBalances($accountNumber)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('accounts/%s/balances', rawurlencode($accountNumber)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Balance($data);
    }
}
