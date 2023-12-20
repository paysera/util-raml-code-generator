<?php

namespace Paysera\Test\LibraryVersionClient;

use Paysera\Test\LibraryVersionClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class LibraryVersionClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new LibraryVersionClient($this->apiClient->withOptions($options));
    }
}
