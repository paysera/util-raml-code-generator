<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Controller;

use Vendor\Test\TransferSurveillanceApiBundle\Entity as Entities;
use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\TransferSurveillanceApiBundle\Service\MatcherManager;
use Vendor\Test\TransferSurveillanceApiBundle\MatcherPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class MatcherApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $matcherManager;
    
    public function __construct(
        MatcherManager $matcherManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->matcherManager = $matcherManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Get Transfer Surveillance Matchers
     * GET /matchers
     *
     * @return Result|Entities\Matcher[]
     */
    public function getMatchers()
    {
        $this->authorizationChecker->check(MatcherPermissions::GET_MATCHERS);
        return $this->matcherManager->getMatchers();
    }
}
