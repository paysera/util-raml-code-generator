<?php

namespace Paysera\Test\TransferSurveillanceClient;

use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;

class ClientFactory extends ClientFactoryAbstract
{
    const DEFAULT_BASE_URL = 'http://example.com/transfer-surveillance/rest/v1/';

    private $apiClient;

    public function __construct(array $options)
    {
        $this->apiClient = $this->createApiClient($options);
    }

    public function getTransferSurveillanceClient()
    {
        return new TransferSurveillanceClient($this->apiClient);
    }
}
