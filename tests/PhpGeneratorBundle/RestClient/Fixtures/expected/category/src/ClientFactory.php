<?php

namespace Paysera\Test\CategoryClient;

use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;

class ClientFactory extends ClientFactoryAbstract
{
    const DEFAULT_BASE_URL = 'https://my-api.example.com/rest/v1/';

    private $apiClient;

    public function __construct(array $options)
    {
        $this->apiClient = $this->createApiClient($options);
    }

    public function getCategoryClient()
    {
        return new CategoryClient($this->apiClient);
    }
}
