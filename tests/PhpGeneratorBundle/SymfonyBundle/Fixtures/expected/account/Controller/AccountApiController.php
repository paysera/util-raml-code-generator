<?php

namespace Vendor\Test\AccountApiBundle\Controller;

use Vendor\Test\AccountApiBundle\Entity as Entities;
use Symfony\Component\HttpFoundation\Response;
use Paysera\Component\Serializer\Entity\Result;
use Paysera\Bundle\RestBundle\Repository\ResultProvider;
use Vendor\Test\AccountApiBundle\Service\AccountManager;
use Vendor\Test\AccountApiBundle\AccountPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class AccountApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $accountResultProvider;
    private $accountManager;
    
    public function __construct(
        ResultProvider $accountResultProvider,
        AccountManager $accountManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->accountResultProvider = $accountResultProvider;
        $this->accountManager = $accountManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Generated JS code
     * GET /accounts/scripts
     *
     * @return Response
     */
    public function getAccountScripts()
    {
        $this->authorizationChecker->check(AccountPermissions::GET_ACCOUNT_SCRIPTS);
        return $this->accountManager->getAccountScripts();
    }
    /**
     * Standard SQL-style Result filtering
     * GET /accounts
     *
     * @param Entities\AccountFilter $accountFilter
     * @return Result|Entities\Account[]
     */
    public function getAccounts(Entities\AccountFilter $accountFilter)
    {
        $this->authorizationChecker->check(AccountPermissions::GET_ACCOUNTS);
        return $this->accountResultProvider->getResult($accountFilter);
    }
}
