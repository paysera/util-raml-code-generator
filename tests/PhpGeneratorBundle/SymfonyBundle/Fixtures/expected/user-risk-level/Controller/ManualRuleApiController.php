<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Controller;

use Vendor\Test\UserRiskLevelApiBundle\Entity as Entities;
use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\UserRiskLevelApiBundle\Service\ManualRuleManager;
use Vendor\Test\UserRiskLevelApiBundle\ManualRulePermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class ManualRuleApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $manualRuleManager;
    
    public function __construct(
        ManualRuleManager $manualRuleManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->manualRuleManager = $manualRuleManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Get available Manual Rules
     * GET /manual-rules
     *
     * @return Result|Entities\ManualRule[]
     */
    public function getManualRules()
    {
        $this->authorizationChecker->check(ManualRulePermissions::GET_MANUAL_RULES);
        return $this->manualRuleManager->getManualRules();
    }
}
