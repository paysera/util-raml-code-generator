<?php

namespace Paysera\Test\TestClient;

use Paysera\Test\TestClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class UserInfoClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Get user by it's id
     * GET /users/{id}/information
     *
     * @param string $id
     * @return Entities\UserInfo
     */
    public function getUserInformation($id)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            sprintf('users/%s/information', urlencode($id)),
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\UserInfo($data);
    }
    /**
     * Updates user resource
     * PUT /users/{id}/information
     *
     * @param string $id
     * @param Entities\UserInfo $userInfo
     * @return Entities\UserInfo
     */
    public function informationUser($id, Entities\UserInfo $userInfo)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_PUT,
            sprintf('users/%s/information', urlencode($id)),
            $userInfo
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\UserInfo($data);
    }
}
