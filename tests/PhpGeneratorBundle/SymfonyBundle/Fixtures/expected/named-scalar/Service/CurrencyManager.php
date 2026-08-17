<?php

namespace Vendor\Test\NamedScalarApiBundle\Service;

use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\NamedScalarApiBundle\Entity as Entities;
use Vendor\Test\NamedScalarApiBundle\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManager;

class CurrencyManager
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Result|string[]
     */
    public function getCurrencies()
    {
        //TODO: generated_code
    }
}
