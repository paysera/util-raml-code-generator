<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Controller;

use Vendor\Test\TransferSurveillanceApiBundle\Entity as Entities;
use Paysera\Component\Serializer\Entity\Result;
use Paysera\Bundle\RestBundle\Repository\ResultProvider;
use Vendor\Test\TransferSurveillanceApiBundle\Service\RuleManager;
use Vendor\Test\TransferSurveillanceApiBundle\RulePermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class RuleApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $ruleResultProvider;
    private $ruleManager;
    
    public function __construct(
        ResultProvider $ruleResultProvider,
        RuleManager $ruleManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->ruleResultProvider = $ruleResultProvider;
        $this->ruleManager = $ruleManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Enable rule
     * PUT /rules/{id}/enable
     *
     * @param Entities\Rule $rule
     * @return null
     */
    public function enableRule(Entities\Rule $rule)
    {
        $this->authorizationChecker->check(RulePermissions::ENABLE_RULE);
        $this->ruleManager->enableRule($rule);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Disable rule
     * PUT /rules/{id}/disable
     *
     * @param Entities\Rule $rule
     * @return null
     */
    public function disableRule(Entities\Rule $rule)
    {
        $this->authorizationChecker->check(RulePermissions::DISABLE_RULE);
        $this->ruleManager->disableRule($rule);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Get a single whitelist
     * GET /rules/{id}/whitelists/{whitelist_id}/profile-list
     *
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $whitelist
     * @return Entities\Whitelist
     */
    public function getRuleWhitelistProfileList(Entities\Rule $rule, Entities\Whitelist $whitelist)
    {
        $this->authorizationChecker->check(RulePermissions::GET_RULE_WHITELIST_PROFILE_LIST);
        return $this->ruleManager->getRuleWhitelistProfileList($rule, $whitelist);
    }
    /**
     * Update whitelist
     * PUT /rules/{id}/whitelists/{whitelist_id}/profile-list
     *
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $originalWhitelist
     * @param Entities\Whitelist $updatedWhitelist
     * @return Entities\Whitelist
     */
    public function updateRuleWhitelistProfileList(Entities\Rule $rule, Entities\Whitelist $originalWhitelist, Entities\Whitelist $updatedWhitelist)
    {
        $this->authorizationChecker->check(RulePermissions::UPDATE_RULE_WHITELIST_PROFILE_LIST);
        $result = $this->ruleManager->updateRuleWhitelistProfileList($rule, $originalWhitelist, $updatedWhitelist);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Get a single whitelist
     * GET /rules/{id}/whitelists/{whitelist_id}
     *
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $whitelist
     * @return Entities\Whitelist
     */
    public function getRuleWhitelist(Entities\Rule $rule, Entities\Whitelist $whitelist)
    {
        $this->authorizationChecker->check(RulePermissions::GET_RULE_WHITELIST);
        return $this->ruleManager->getRuleWhitelist($rule, $whitelist);
    }
    /**
     * Update whitelist
     * PUT /rules/{id}/whitelists/{whitelist_id}
     *
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $originalWhitelist
     * @param Entities\Whitelist $updatedWhitelist
     * @return Entities\Whitelist
     */
    public function updateRuleWhitelist(Entities\Rule $rule, Entities\Whitelist $originalWhitelist, Entities\Whitelist $updatedWhitelist)
    {
        $this->authorizationChecker->check(RulePermissions::UPDATE_RULE_WHITELIST);
        $result = $this->ruleManager->updateRuleWhitelist($rule, $originalWhitelist, $updatedWhitelist);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Delete a whitelist
     * DELETE /rules/{id}/whitelists/{whitelist_id}
     *
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $whitelist
     * @return null
     */
    public function deleteRuleWhitelist(Entities\Rule $rule, Entities\Whitelist $whitelist)
    {
        $this->authorizationChecker->check(RulePermissions::DELETE_RULE_WHITELIST);
        $this->ruleManager->deleteRuleWhitelist($rule, $whitelist);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Get all active whitelists for this rule
     * GET /rules/{id}/whitelists
     *
     * @param Entities\Rule $rule
     * @return Result|Entities\Whitelist[]
     */
    public function getRuleWhitelists(Entities\Rule $rule)
    {
        $this->authorizationChecker->check(RulePermissions::GET_RULE_WHITELISTS);
        return $this->ruleManager->getRuleWhitelists($rule);
    }
    /**
     * Add whitelist to a rule
     * POST /rules/{id}/whitelists
     *
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $whitelist
     * @return Entities\Whitelist
     */
    public function createRuleWhitelist(Entities\Rule $rule, Entities\Whitelist $whitelist)
    {
        $this->authorizationChecker->check(RulePermissions::CREATE_RULE_WHITELIST);
        $result = $this->ruleManager->createRuleWhitelist($rule, $whitelist);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Get a rule
     * GET /rules/{id}
     *
     * @param Entities\Rule $rule
     * @return Entities\Rule
     */
    public function getRule(Entities\Rule $rule)
    {
        $this->authorizationChecker->check(RulePermissions::GET_RULE);
        return $this->ruleManager->getRule($rule);
    }
    /**
     * Update rule
     * PUT /rules/{id}
     *
     * @param Entities\Rule $originalRule
     * @param Entities\Rule $updatedRule
     * @return Entities\Rule
     */
    public function updateRule(Entities\Rule $originalRule, Entities\Rule $updatedRule)
    {
        $this->authorizationChecker->check(RulePermissions::UPDATE_RULE);
        $result = $this->ruleManager->updateRule($originalRule, $updatedRule);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Delete a rule
     * DELETE /rules/{id}
     *
     * @param Entities\Rule $rule
     * @return null
     */
    public function deleteRule(Entities\Rule $rule)
    {
        $this->authorizationChecker->check(RulePermissions::DELETE_RULE);
        $this->ruleManager->deleteRule($rule);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Standard SQL-style Result filtering
     * GET /rules
     *
     * @param Entities\RuleFilter $ruleFilter
     * @return Result|Entities\Rule[]
     */
    public function getRules(Entities\RuleFilter $ruleFilter)
    {
        $this->authorizationChecker->check(RulePermissions::GET_RULES);
        return $this->ruleResultProvider->getResult($ruleFilter);
    }
    /**
     * Create a rule
     * POST /rules
     *
     * @param Entities\Rule $rule
     * @return Entities\Rule
     */
    public function createRule(Entities\Rule $rule)
    {
        $this->authorizationChecker->check(RulePermissions::CREATE_RULE);
        $result = $this->ruleManager->createRule($rule);
        $this->entityManager->flush();
        return $result;
    }
}
