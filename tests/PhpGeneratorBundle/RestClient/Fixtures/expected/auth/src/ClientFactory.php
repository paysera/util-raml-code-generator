<?php

namespace Paysera\Test\AuthClient;

use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class ClientFactory extends ClientFactoryAbstract
{
    const DEFAULT_BASE_URL = 'https://my-api.example.com/rest/v1/';

    private $apiClient;

    public function __construct($optionsOrClient)
    {
        if ($optionsOrClient instanceof ApiClient) {
            $this->apiClient = $optionsOrClient;
        } else {
            $this->apiClient = $this->createApiClient($optionsOrClient);
        }
    }

    public function getAuthClient()
    {
        return new AuthClient($this->apiClient);
    }
}
