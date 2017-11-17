<?php

namespace Paysera\Test\TestClient;

use Paysera\Component\RestClientCommon\Client\ApiClient;
use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;

class ClientFactory extends ClientFactoryAbstract
{
    const DEFAULT_BASE_URL = 'http://gateway.paysera.com/transfer-surveillance/rest/v1/';

    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getTransferSurveillanceClient()
    {
        return new TransferSurveillanceClient($this->apiClient);
    }
}
