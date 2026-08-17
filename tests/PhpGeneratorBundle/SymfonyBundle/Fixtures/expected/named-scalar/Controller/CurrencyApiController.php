<?php

namespace Vendor\Test\NamedScalarApiBundle\Controller;

use Vendor\Test\NamedScalarApiBundle\Entity as Entities;
use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\NamedScalarApiBundle\Service\CurrencyManager;
use Vendor\Test\NamedScalarApiBundle\CurrencyPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class CurrencyApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $currencyManager;
    
    public function __construct(
        CurrencyManager $currencyManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->currencyManager = $currencyManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * List currencies
     * GET /currencies
     *
     * @return Result|string[]
     */
    public function getCurrencies()
    {
        $this->authorizationChecker->check(CurrencyPermissions::GET_CURRENCIES);
        return $this->currencyManager->getCurrencies();
    }
}
