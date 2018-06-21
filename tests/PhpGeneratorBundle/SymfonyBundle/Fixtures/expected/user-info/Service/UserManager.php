<?php

namespace Vendor\Test\UserInfoApiBundle\Service;

use Vendor\Test\UserInfoApiBundle\Entity as Entities;
use Vendor\Test\UserInfoApiBundle\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

class UserManager
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Entities\Legal $legal
     * @return null
     */
    public function createLegalUser(Entities\Legal $legal)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Natural $natural
     * @return null
     */
    public function createNaturalUser(Entities\Natural $natural)
    {
        //TODO: generated_code
    }
    /**
     * @param string $id
     * @return Entities\UserInfo
     */
    public function getUserInformation($id)
    {
        //TODO: generated_code
    }
    /**
     * @param string $id
     * @param Entities\UserInfo $userInfo
     * @return Entities\UserInfo
     */
    public function updateUserInformation($id, Entities\UserInfo $userInfo)
    {
        //TODO: generated_code
    }
}
