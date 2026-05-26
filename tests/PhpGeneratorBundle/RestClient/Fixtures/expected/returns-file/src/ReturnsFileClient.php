<?php

namespace Paysera\Test\ReturnsFileClient;

use Paysera\Test\ReturnsFileClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Entity\Entity;
use Paysera\Component\RestClientCommon\Client\ApiClient;
use Paysera\Component\RestClientCommon\Entity\File;

class ReturnsFileClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new ReturnsFileClient($this->apiClient->withOptions($options));
    }

    /**
     * GET /accounts/{accountNumber}/statement/file
     *
     * @param string $accountNumber
     * @return File
     */
    public function getAccountStatementFile($accountNumber)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('accounts/%s/statement/file', rawurlencode($accountNumber)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new File($data);
    }
}
