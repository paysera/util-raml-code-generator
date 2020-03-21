<?php

namespace Vendor\Test\CustomApiBundle\Controller;

use Vendor\Test\CustomApiBundle\Entity as Entities;
use Vendor\Test\CustomApiBundle\Service\SomethingManager;
use Vendor\Test\CustomApiBundle\SomethingPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class SomethingApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $somethingManager;
    
    public function __construct(
        SomethingManager $somethingManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->somethingManager = $somethingManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * 
     * GET /something
     *
     * @return null
     */
    public function customNameForMethod()
    {
        $this->authorizationChecker->check(SomethingPermissions::CUSTOM_NAME_FOR_METHOD);
        return $this->somethingManager->customNameForMethod();
    }
}
