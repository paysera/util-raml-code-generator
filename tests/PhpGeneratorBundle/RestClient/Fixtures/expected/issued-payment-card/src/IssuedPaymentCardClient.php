<?php

namespace Paysera\Test\IssuedPaymentCardClient;

use Paysera\Test\IssuedPaymentCardClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class IssuedPaymentCardClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new IssuedPaymentCardClient($this->apiClient->withOptions($options));
    }

    /**
     * Price by payer country, client type and card owner id
     * GET /card-issue-price/{country}/{clientType}/{cardOwnerId}
     *
     * @param string $country
     * @param string $clientType
     * @param string $cardOwnerId
     * @return Entities\CardIssuePrice
     */
    public function getCardIssuePrice($country, $clientType, $cardOwnerId)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('card-issue-price/%s/%s/%s', urlencode($country), urlencode($clientType), urlencode($cardOwnerId)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\CardIssuePrice($data);
    }
}
