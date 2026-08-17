<?php

namespace Paysera\Test\NamedScalarClient;

use Paysera\Test\NamedScalarClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class NamedScalarClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new NamedScalarClient($this->apiClient->withOptions($options));
    }

    /**
     * Create payment
     * POST /payments
     *
     * @param Entities\Payment $payment
     * @return Entities\Payment
     */
    public function createPayment(Entities\Payment $payment)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'payments',
            $payment
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\Payment($data);
    }

    /**
     * List currencies
     * GET /currencies
     *
     * @return Entities\CurrencyResult
     */
    public function getCurrencies()
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'currencies',
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\CurrencyResult($data, 'currencies');
    }
}
