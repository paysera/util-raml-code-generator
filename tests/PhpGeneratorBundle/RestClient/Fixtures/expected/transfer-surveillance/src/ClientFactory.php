<?php

namespace Paysera\Test\TransferSurveillanceClient;

use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class ClientFactory extends ClientFactoryAbstract
{
    const DEFAULT_BASE_URL = 'http://example.com/transfer-surveillance/rest/v1/';

    private $apiClient;

    public function __construct($optionsOrClient)
    {
        if ($optionsOrClient instanceof ApiClient) {
            $this->apiClient = $optionsOrClient;
        } else {
            $this->apiClient = $this->createApiClient($optionsOrClient);
        }
    }

    public function getTransferSurveillanceClient()
    {
        return new TransferSurveillanceClient($this->apiClient);
    }
}
