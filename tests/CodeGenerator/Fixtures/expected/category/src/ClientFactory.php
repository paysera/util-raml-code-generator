<?php

namespace Paysera\Test\TestClient;

use Paysera\Component\RestClientCommon\Client\ApiClient;
use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;

class ClientFactory extends ClientFactoryAbstract
{
    const DEFAULT_BASE_URL = 'https://my-api.example.com/rest/v1/';

    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getCategoryClient()
    {
        return new CategoryClient($this->apiClient);
    }
}
