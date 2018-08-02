<?php

namespace Paysera\Test\ReturnsMoneyClient;

use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class ClientFactory extends ClientFactoryAbstract
{
    const DEFAULT_BASE_URL = 'https://example.com/accounts/rest/v1/';

    private $apiClient;

    public function __construct($optionsOrClient)
    {
        if ($optionsOrClient instanceof ApiClient) {
            $this->apiClient = $optionsOrClient;
        } else {
            $this->apiClient = $this->createApiClient($optionsOrClient);
        }
    }

    public function getReturnsMoneyClient()
    {
        return new ReturnsMoneyClient($this->apiClient);
    }
}
