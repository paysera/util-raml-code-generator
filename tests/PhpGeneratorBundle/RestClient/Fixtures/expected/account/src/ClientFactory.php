<?php

namespace Paysera\Test\AccountClient;

use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;

class ClientFactory extends ClientFactoryAbstract
{
    const DEFAULT_BASE_URL = 'https://my-api.example.com/rest/v1/';

    private $apiClient;

    public function __construct(array $options)
    {
        $this->apiClient = $this->createApiClient($options);
    }

    public function getAccountClient()
    {
        return new AccountClient($this->apiClient);
    }
}
