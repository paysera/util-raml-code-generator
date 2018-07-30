<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Service;

use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\UserRiskLevelApiBundle\Entity as Entities;
use Vendor\Test\UserRiskLevelApiBundle\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

class UserManager
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $userId
     * @return Entities\RiskLevel
     */
    public function getUserRiskLevel($userId)
    {
        //TODO: generated_code
    }
    /**
     * @param string $userId
     * @param Entities\AuditableManualRule $auditableManualRule
     * @param Entities\AuditRecord $auditRecord
     * @return null
     */
    public function deleteUserManualRule($userId, Entities\AuditableManualRule $auditableManualRule, Entities\AuditRecord $auditRecord)
    {
        //TODO: generated_code
    }
    /**
     * @param string $userId
     * @return Result|Entities\ManualRule[]
     */
    public function getUserManualRules($userId)
    {
        //TODO: generated_code
    }
    /**
     * @param string $userId
     * @param Entities\AuditableManualRule $auditableManualRule
     * @return Entities\ManualRule
     */
    public function createUserManualRule($userId, Entities\AuditableManualRule $auditableManualRule)
    {
        //TODO: generated_code
    }
}
