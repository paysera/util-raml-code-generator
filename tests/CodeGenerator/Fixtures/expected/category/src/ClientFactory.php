<?php

namespace Paysera\Test\TestClient;

use Paysera\Component\RestClientCommon\Client\ApiClient;
use Paysera\Component\RestClientCommon\Util\ClientFactoryAbstract;

class ClientFactory extends ClientFactoryAbstract
{
    protected static $baseUrl = 'https://example.com/category/rest/v1/';
    protected static $oauthBaseUrl = 'https://wallet.paysera.com/oauth/v1/';

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
