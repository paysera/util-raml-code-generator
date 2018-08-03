<?php

namespace Paysera\Test\UserInfoClient;

use Paysera\Test\UserInfoClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class UserInfoClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function withOptions(array $options)
    {
        return new UserInfoClient($this->apiClient->withOptions($options));
    }

    /**
     * Creates Legal User
     * POST /users/legal
     *
     * @param Entities\Legal $legal
     * @return null
     */
    public function createLegalUser(Entities\Legal $legal)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'users/legal',
            $legal
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }

    /**
     * Creates Natural User
     * POST /users/natural
     *
     * @param Entities\Natural $natural
     * @return null
     */
    public function createNaturalUser(Entities\Natural $natural)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'users/natural',
            $natural
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
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
    public function updateUserInformation($id, Entities\UserInfo $userInfo)
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
