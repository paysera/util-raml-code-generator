<?php

namespace Vendor\Test\IssuedPaymentCardApiBundle\Service;

use Vendor\Test\IssuedPaymentCardApiBundle\Entity as Entities;
use Vendor\Test\IssuedPaymentCardApiBundle\Repository\CardIssuePriceRepository;
use Doctrine\ORM\EntityManager;

class CardIssuePriceManager
{
    private $cardIssuePriceRepository;
    private $entityManager;

    public function __construct(
        CardIssuePriceRepository $cardIssuePriceRepository,
        EntityManager $entityManager
    ) {
        $this->cardIssuePriceRepository = $cardIssuePriceRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $country
     * @param string $clientType
     * @param string $cardOwnerId
     * @return Entities\CardIssuePrice
     */
    public function getCardIssuePrice($country, $clientType, $cardOwnerId)
    {
        //TODO: generated_code
    }
}
