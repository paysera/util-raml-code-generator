<?php

namespace Vendor\Test\UserInfoApiBundle\Controller;

use Vendor\Test\UserInfoApiBundle\Entity as Entities;
use Vendor\Test\UserInfoApiBundle\Service\UserManager;
use Vendor\Test\UserInfoApiBundle\UserPermissions;
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
     * Creates Legal User
     * POST /users/legal
     *
     * @param Entities\Legal $legal
     * @return null
     */
    public function createLegalUser(Entities\Legal $legal)
    {
        $this->authorizationChecker->check(UserPermissions::CREATE_LEGAL_USER);
        $this->userManager->createLegalUser($legal);
        $this->entityManager->flush();
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
        $this->authorizationChecker->check(UserPermissions::CREATE_NATURAL_USER);
        $this->userManager->createNaturalUser($natural);
        $this->entityManager->flush();
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
        $this->authorizationChecker->check(UserPermissions::GET_USER_INFORMATION);
        return $this->userManager->getUserInformation($id);
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
        $this->authorizationChecker->check(UserPermissions::UPDATE_USER_INFORMATION);
        $result = $this->userManager->updateUserInformation($id, $userInfo);
        $this->entityManager->flush();
        return $result;
    }
}
