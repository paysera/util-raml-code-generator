<?php

namespace Paysera\Test\InheritanceClient;

use Paysera\Test\InheritanceClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class InheritanceClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * User Natural Filter
     * GET /users/natural
     *
     * @param Entities\UserNaturalFilter $userNaturalFilter
     * @return Entities\UserNatural
     */
    public function getUserNatural(Entities\UserNaturalFilter $userNaturalFilter)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'users/natural',
            $userNaturalFilter
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\UserNatural($data);
    }
    /**
     * Creates Natural user
     * POST /users/natural
     *
     * @param Entities\UserNatural $userNatural
     * @return Entities\UserNatural
     */
    public function createNaturalUser(Entities\UserNatural $userNatural)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'users/natural',
            $userNatural
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\UserNatural($data);
    }
    /**
     * Standard SQL-style Result filtering
     * GET /users/legal
     *
     * @param Entities\UserLegalFilter $userLegalFilter
     * @return Entities\UserLegal
     */
    public function getUserLegal(Entities\UserLegalFilter $userLegalFilter)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'users/legal',
            $userLegalFilter
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\UserLegal($data);
    }
    /**
     * Creates Legal user
     * POST /users/legal
     *
     * @param Entities\UserLegal $userLegal
     * @return Entities\UserLegal
     */
    public function createLegalUser(Entities\UserLegal $userLegal)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'users/legal',
            $userLegal
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\UserLegal($data);
    }
    /**
     * Standard SQL-style Result filtering
     * GET /users
     *
     * @param Entities\UserFilter $userFilter
     * @return Entities\UserBasic[]
     */
    public function getUsers(Entities\UserFilter $userFilter)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_GET,
            'users',
            $userFilter
        );
        $data = $this->apiClient->makeRequest($request);

        return array_map(function ($item) { return new Entities\UserBasic($item); }, $data);
    }
    /**
     * Creates Basic user
     * POST /users
     *
     * @param Entities\UserBasic $userBasic
     * @return Entities\UserBasic
     */
    public function createUser(Entities\UserBasic $userBasic)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'users',
            $userBasic
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\UserBasic($data);
    }
}
