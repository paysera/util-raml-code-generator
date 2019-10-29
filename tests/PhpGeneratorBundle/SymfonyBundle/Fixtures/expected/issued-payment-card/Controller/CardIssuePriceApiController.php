<?php

namespace Vendor\Test\IssuedPaymentCardApiBundle\Controller;

use Vendor\Test\IssuedPaymentCardApiBundle\Entity as Entities;
use Vendor\Test\IssuedPaymentCardApiBundle\Service\CardIssuePriceManager;
use Vendor\Test\IssuedPaymentCardApiBundle\CardIssuePricePermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class CardIssuePriceApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $cardIssuePriceManager;
    
    public function __construct(
        CardIssuePriceManager $cardIssuePriceManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->cardIssuePriceManager = $cardIssuePriceManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Price by payer country, client type and card owner id
     * GET /card-issue-price/{country}/{clientType}/{cardOwnerId}
     *
     * @param string $country
     * @param string $clientType
     * @param string $cardOwnerId
     * @return Entities\CardIssuePrice
     */
    public function getCardIssuePrice($country, $clientType, $cardOwnerId)
    {
        $this->authorizationChecker->check(CardIssuePricePermissions::GET_CARD_ISSUE_PRICE);
        return $this->cardIssuePriceManager->getCardIssuePrice($country, $clientType, $cardOwnerId);
    }
}
