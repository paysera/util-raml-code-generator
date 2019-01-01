<?php

namespace Paysera\Test\PublicTransfersClient;

use Paysera\Test\PublicTransfersClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;
use Evp\Component\Money\Money;

class PublicTransfersClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new PublicTransfersClient($this->apiClient->withOptions($options));
    }

    /**
     * Returns the amount required as an addition to the account balance in order to be able to execute the transfer.
     * GET /transfers/{transferId}/required-supplement
     *
     * @param string $transferId
     * @return Money
     */
    public function getTransferRequiredSupplement($transferId)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('transfers/%s/required-supplement', urlencode($transferId)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Money($data['amount'], $data['currency']);
    }

    /**
     * Unlocks SMS challenge
     * PUT /transfers/{transferId}/sms
     *
     * @param string $transferId
     * @return null
     */
    public function updateTransferSms($transferId)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('transfers/%s/sms', urlencode($transferId)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
}
