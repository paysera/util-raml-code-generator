<?php

namespace Vendor\Test\AuthApiBundle\Service;

use Vendor\Test\AuthApiBundle\Entity as Entities;
use Vendor\Test\AuthApiBundle\Repository\TokenRepository;
use Doctrine\ORM\EntityManager;

class TokenManager
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Entities\Credentials $credentials
     * @return Entities\AuthTokenResponse
     */
    public function createAuthToken(Entities\Credentials $credentials)
    {
        //TODO: generated_code
    }
    /**
     * @return null
     */
    public function deleteAuthToken()
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\SystemTokenRequest $systemTokenRequest
     * @return Entities\SystemToken
     */
    public function createOptionalSystemToken(Entities\SystemTokenRequest $systemTokenRequest)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\SystemTokenRequest $systemTokenRequest
     * @return Entities\SystemTokenResponse
     */
    public function createStrictSystemToken(Entities\SystemTokenRequest $systemTokenRequest)
    {
        //TODO: generated_code
    }
}
