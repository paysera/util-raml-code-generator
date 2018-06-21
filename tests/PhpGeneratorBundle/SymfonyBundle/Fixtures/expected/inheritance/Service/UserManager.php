<?php

namespace Vendor\Test\InheritanceApiBundle\Service;

use Symfony\Component\HttpFoundation\Response;
use Vendor\Test\InheritanceApiBundle\Entity as Entities;
use Vendor\Test\InheritanceApiBundle\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

class UserManager
{
    private $userRepository;
    private $entityManager;

    public function __construct(
        UserRepository $userRepository,
        EntityManager $entityManager
    ) {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Entities\UserNaturalFilter $userNaturalFilter
     * @return Entities\UserNatural
     */
    public function getUserNatural(Entities\UserNaturalFilter $userNaturalFilter)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\UserNatural $userNatural
     * @return Entities\UserNatural
     */
    public function createNaturalUser(Entities\UserNatural $userNatural)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\UserLegalFilter $userLegalFilter
     * @return Entities\UserLegal
     */
    public function getUserLegal(Entities\UserLegalFilter $userLegalFilter)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\UserLegal $userLegal
     * @return Entities\UserLegal
     */
    public function createLegalUser(Entities\UserLegal $userLegal)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\UserFilter $userFilter
     * @return Response
     */
    public function getUsers(Entities\UserFilter $userFilter)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\UserBasic $userBasic
     * @return Entities\UserBasic
     */
    public function createUser(Entities\UserBasic $userBasic)
    {
        //TODO: generated_code
    }
}
