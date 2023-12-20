<?php

namespace Paysera\Test\PlatformVersionClient;

use Paysera\Test\PlatformVersionClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class PlatformVersionClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new PlatformVersionClient($this->apiClient->withOptions($options));
    }
}
