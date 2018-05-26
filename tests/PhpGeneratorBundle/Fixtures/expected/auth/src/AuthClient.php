<?php

namespace Paysera\Test\AuthClient;

use Paysera\Test\AuthClient\Entity as Entities;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Component\RestClientCommon\Client\ApiClient;

class AuthClient
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Create auth token
     * POST /tokens/auth
     *
     * @param Entities\Credentials $credentials
     * @return Entities\AuthTokenResponse
     */
    public function createAuthToken(Entities\Credentials $credentials)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'tokens/auth',
            $credentials
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\AuthTokenResponse($data);
    }
    /**
     * Invalidate auth token
     * DELETE /tokens/auth
     *
     * @return null
     */
    public function deleteAuthToken()
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_DELETE,
            'tokens/auth',
            null
        );
        $data = $this->apiClient->makeRequest($request);

        return null;
    }
    /**
     * Creates system token by the requested scopes. If user can't access all the scopes - returns token created by the scopes user can access
     * POST /tokens/system/optional
     *
     * @param Entities\SystemTokenRequest $systemTokenRequest
     * @return Entities\SystemToken
     */
    public function createOptionalSystemToken(Entities\SystemTokenRequest $systemTokenRequest)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'tokens/system/optional',
            $systemTokenRequest
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\SystemToken($data);
    }
    /**
     * Creates system token by the requested scopes. If user can't access all the scopes - returns challenge
     * POST /tokens/system/strict
     *
     * @param Entities\SystemTokenRequest $systemTokenRequest
     * @return Entities\SystemTokenResponse
     */
    public function createStrictSystemToken(Entities\SystemTokenRequest $systemTokenRequest)
    {
        $request = $this->apiClient->createRequest(
            RequestMethodInterface::METHOD_POST,
            'tokens/system/strict',
            $systemTokenRequest
        );
        $data = $this->apiClient->makeRequest($request);

        return new Entities\SystemTokenResponse($data);
    }
}
