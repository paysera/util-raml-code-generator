<?php

namespace Paysera\Test\TestClient;

use Paysera\Test\TestClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class AccountClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Generated JS code
     * GET /accounts/scripts
     *
     * @return string
     */
    public function getAccountScripts()
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'accounts/scripts',
            null
        );
        return $this->apiClient->makeRawRequest($request)->getBody()->getContents();
    }
    /**
     * Standard SQL-style Result filtering
     * GET /accounts
     *
     * @param Entities\AccountFilter $accountFilter
     * @return Entities\AccountResult
     */
    public function getAccounts(Entities\AccountFilter $accountFilter)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'accounts',
            $accountFilter
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\AccountResult($data, 'accounts');
    }
}
