<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Service;

use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\UserRiskLevelApiBundle\Entity as Entities;
use Vendor\Test\UserRiskLevelApiBundle\Repository\ManualRuleRepository;
use Doctrine\ORM\EntityManager;

class ManualRuleManager
{
    private $manualRuleRepository;
    private $entityManager;

    public function __construct(
        ManualRuleRepository $manualRuleRepository,
        EntityManager $entityManager
    ) {
        $this->manualRuleRepository = $manualRuleRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @return Result|Entities\ManualRule[]
     */
    public function getManualRules()
    {
        //TODO: generated_code
    }
}
