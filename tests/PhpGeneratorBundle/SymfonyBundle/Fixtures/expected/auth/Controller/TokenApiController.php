<?php

namespace Vendor\Test\AuthApiBundle\Controller;

use Vendor\Test\AuthApiBundle\Entity as Entities;
use Vendor\Test\AuthApiBundle\Service\TokenManager;
use Vendor\Test\AuthApiBundle\TokenPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class TokenApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $tokenManager;
    
    public function __construct(
        TokenManager $tokenManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->tokenManager = $tokenManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
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
        $this->authorizationChecker->check(TokenPermissions::CREATE_AUTH_TOKEN);
        $result = $this->tokenManager->createAuthToken($credentials);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Invalidate auth token
     * DELETE /tokens/auth
     *
     * @return null
     */
    public function deleteAuthToken()
    {
        $this->authorizationChecker->check(TokenPermissions::DELETE_AUTH_TOKEN);
        $this->tokenManager->deleteAuthToken();
        $this->entityManager->flush();
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
        $this->authorizationChecker->check(TokenPermissions::CREATE_OPTIONAL_SYSTEM_TOKEN);
        $result = $this->tokenManager->createOptionalSystemToken($systemTokenRequest);
        $this->entityManager->flush();
        return $result;
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
        $this->authorizationChecker->check(TokenPermissions::CREATE_STRICT_SYSTEM_TOKEN);
        $result = $this->tokenManager->createStrictSystemToken($systemTokenRequest);
        $this->entityManager->flush();
        return $result;
    }
}
