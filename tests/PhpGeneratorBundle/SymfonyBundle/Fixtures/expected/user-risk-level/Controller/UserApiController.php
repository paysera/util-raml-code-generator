<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Controller;

use Vendor\Test\UserRiskLevelApiBundle\Entity as Entities;
use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\UserRiskLevelApiBundle\Service\UserManager;
use Vendor\Test\UserRiskLevelApiBundle\UserPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class UserApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $userManager;
    
    public function __construct(
        UserManager $userManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->userManager = $userManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Get user Risk Level
     * GET /users/{userId}/risk-level
     *
     * @param string $userId
     * @return Entities\RiskLevel
     */
    public function getUserRiskLevel($userId)
    {
        $this->authorizationChecker->check(UserPermissions::GET_USER_RISK_LEVEL);
        return $this->userManager->getUserRiskLevel($userId);
    }
    /**
     * Delete Manual Rule for User
     * DELETE /users/{userId}/manual-rules/{ruleId}
     *
     * @param string $userId
     * @param Entities\AuditableManualRule $auditableManualRule
     * @param Entities\AuditRecord $auditRecord
     * @return null
     */
    public function deleteUserManualRule($userId, Entities\AuditableManualRule $auditableManualRule, Entities\AuditRecord $auditRecord)
    {
        $this->authorizationChecker->check(UserPermissions::DELETE_USER_MANUAL_RULE);
        $this->userManager->deleteUserManualRule($userId, $auditableManualRule, $auditRecord);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Get Manual Rules applied for User
     * GET /users/{userId}/manual-rules
     *
     * @param string $userId
     * @return Result|Entities\ManualRule[]
     */
    public function getUserManualRules($userId)
    {
        $this->authorizationChecker->check(UserPermissions::GET_USER_MANUAL_RULES);
        return $this->userManager->getUserManualRules($userId);
    }
    /**
     * Create Manual Rule for User
     * POST /users/{userId}/manual-rules
     *
     * @param string $userId
     * @param Entities\AuditableManualRule $auditableManualRule
     * @return Entities\ManualRule
     */
    public function createUserManualRule($userId, Entities\AuditableManualRule $auditableManualRule)
    {
        $this->authorizationChecker->check(UserPermissions::CREATE_USER_MANUAL_RULE);
        $result = $this->userManager->createUserManualRule($userId, $auditableManualRule);
        $this->entityManager->flush();
        return $result;
    }
}
