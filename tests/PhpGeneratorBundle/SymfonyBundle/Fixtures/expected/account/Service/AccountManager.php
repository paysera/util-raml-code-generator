<?php

namespace Vendor\Test\AccountApiBundle\Service;

use Symfony\Component\HttpFoundation\Response;
use Vendor\Test\AccountApiBundle\Entity as Entities;
use Vendor\Test\AccountApiBundle\Repository\AccountRepository;
use Doctrine\ORM\EntityManager;

class AccountManager
{
    private $accountRepository;
    private $entityManager;

    public function __construct(
        AccountRepository $accountRepository,
        EntityManager $entityManager
    ) {
        $this->accountRepository = $accountRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @return Response
     */
    public function getAccountScripts()
    {
        //TODO: generated_code
    }
}
