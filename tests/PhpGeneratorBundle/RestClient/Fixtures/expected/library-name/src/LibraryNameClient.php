<?php

namespace Paysera\Test\LibraryNameClient;

use Paysera\Test\LibraryNameClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class LibraryNameClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new LibraryNameClient($this->apiClient->withOptions($options));
    }
}
