<?php

namespace Paysera\Test\AccountClient;

use Paysera\Test\AccountClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;
use Evp\Component\Money\Money;

class AccountClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new AccountClient($this->apiClient->withOptions($options));
    }

    /**
     * Generated JS code
     * GET /accounts/scripts
     *
     * @return string
     */
    public function getAccountScripts()
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'accounts/scripts',
            null
        );
        return $this->apiClient->makeRawRequest($request)->getBody()->getContents();
    }

    /**
     * Standard SQL-style Result filtering
     * GET /accounts
     *
     * @param Entities\AccountFilter $accountFilter
     * @return Entities\AccountResult
     */
    public function getAccounts(Entities\AccountFilter $accountFilter)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'accounts',
            $accountFilter
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\AccountResult($data, 'accounts');
    }

    /**
     * Gets the commissions Money for the refund of given Request
     * GET /refund/{requestId}/price
     *
     * @param string $requestId
     * @return Money
     */
    public function getRefundPrice($requestId)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('refund/%s/price', urlencode($requestId)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Money($data['amount'], $data['currency']);
    }

    /**
     * Makes the refund
     * POST /refund/{requestId}
     *
     * @param string $requestId
     * @param Money $money
     * @return null
     */
    public function createRefund($requestId, Money $money)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            sprintf('refund/%s', urlencode($requestId)),
            new Entity(['amount' => $money->getAmount(), 'currency' => $money->getCurrency()])
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
}
