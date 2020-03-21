<?php

namespace Vendor\Test\CustomApiBundle\Service;

use Vendor\Test\CustomApiBundle\Entity as Entities;
use Vendor\Test\CustomApiBundle\Repository\SomethingRepository;
use Doctrine\ORM\EntityManager;

class SomethingManager
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @return null
     */
    public function customNameForMethod()
    {
        //TODO: generated_code
    }
}
