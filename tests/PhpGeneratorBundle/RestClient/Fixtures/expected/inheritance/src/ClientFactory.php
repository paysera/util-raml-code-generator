<?php

namespace Paysera\Test\InheritanceClient;

use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;

class ClientFactory extends ClientFactoryAbstract
{
    const DEFAULT_BASE_URL = 'https://example.com/user/rest/v1/';

    private $apiClient;

    public function __construct(array $options)
    {
        $this->apiClient = $this->createApiClient($options);
    }

    public function getInheritanceClient()
    {
        return new InheritanceClient($this->apiClient);
    }
}
