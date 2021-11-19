<?php

namespace Paysera\Test\CategoryClient;

use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class ClientFactory extends ClientFactoryAbstract
{
    const DEFAULT_BASE_URL = 'https://my-api.example.com/rest/v1/';

    protected $apiClient;

    public function __construct($options)
    {
        if ($options instanceof ApiClient) {
            $this->apiClient = $options;
            return;
        }

        $defaultUrlParameters = [];
        
        $options['url_parameters'] = $this->resolveDefaultUrlParameters($defaultUrlParameters, $options);
        $this->apiClient = $this->createApiClient($options);
    }

    public function getCategoryClient()
    {
        return new CategoryClient($this->apiClient);
    }

    private function resolveDefaultUrlParameters(array $defaults, array $options)
    {
        $params = [];
        if (isset($options['url_parameters'])) {
            $params = $options['url_parameters'];
        }

        return $params + $defaults;
    }
}
