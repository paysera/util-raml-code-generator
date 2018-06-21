<?php

namespace Vendor\Test\InheritanceApiBundle\Controller;

use Vendor\Test\InheritanceApiBundle\Entity as Entities;
use Symfony\Component\HttpFoundation\Response;
use Vendor\Test\InheritanceApiBundle\Service\UserManager;
use Vendor\Test\InheritanceApiBundle\UserPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class UserApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $userManager;
    
    public function __construct(
        UserManager $userManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->userManager = $userManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
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
        $this->authorizationChecker->check(UserPermissions::GET_USER_NATURAL);
        return $this->userManager->getUserNatural($userNaturalFilter);
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
        $this->authorizationChecker->check(UserPermissions::CREATE_NATURAL_USER);
        $result = $this->userManager->createNaturalUser($userNatural);
        $this->entityManager->flush();
        return $result;
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
        $this->authorizationChecker->check(UserPermissions::GET_USER_LEGAL);
        return $this->userManager->getUserLegal($userLegalFilter);
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
        $this->authorizationChecker->check(UserPermissions::CREATE_LEGAL_USER);
        $result = $this->userManager->createLegalUser($userLegal);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Standard SQL-style Result filtering
     * GET /users
     *
     * @param Entities\UserFilter $userFilter
     * @return Response
     */
    public function getUsers(Entities\UserFilter $userFilter)
    {
        $this->authorizationChecker->check(UserPermissions::GET_USERS);
        return $this->userManager->getUsers($userFilter);
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
        $this->authorizationChecker->check(UserPermissions::CREATE_USER);
        $result = $this->userManager->createUser($userBasic);
        $this->entityManager->flush();
        return $result;
    }
}
