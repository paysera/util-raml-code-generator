<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Service;

use Vendor\Test\TransferSurveillanceApiBundle\Entity as Entities;
use Vendor\Test\TransferSurveillanceApiBundle\Repository\RuleRepository;
use Doctrine\ORM\EntityManager;

class RuleManager
{
    private $ruleRepository;
    private $entityManager;

    public function __construct(
        RuleRepository $ruleRepository,
        EntityManager $entityManager
    ) {
        $this->ruleRepository = $ruleRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Entities\Rule $rule
     * @return null
     */
    public function enableRule(Entities\Rule $rule)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @return null
     */
    public function disableRule(Entities\Rule $rule)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $whitelist
     * @return Entities\Whitelist
     */
    public function getRuleWhitelistProfileList(Entities\Rule $rule, Entities\Whitelist $whitelist)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $whitelist
     * @param Entities\Whitelist $whitelist
     * @return Entities\Whitelist
     */
    public function updateRuleWhitelistProfileList(Entities\Rule $rule, Entities\Whitelist $originalWhitelist, Entities\Whitelist $updatedWhitelist)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $whitelist
     * @return Entities\Whitelist
     */
    public function getRuleWhitelist(Entities\Rule $rule, Entities\Whitelist $whitelist)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $whitelist
     * @param Entities\Whitelist $whitelist
     * @return Entities\Whitelist
     */
    public function updateRuleWhitelist(Entities\Rule $rule, Entities\Whitelist $originalWhitelist, Entities\Whitelist $updatedWhitelist)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $whitelist
     * @return null
     */
    public function deleteRuleWhitelist(Entities\Rule $rule, Entities\Whitelist $whitelist)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @return Result|Entities\Whitelist[]
     */
    public function getRuleWhitelists(Entities\Rule $rule)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @param Entities\Whitelist $whitelist
     * @return Entities\Whitelist
     */
    public function createRuleWhitelist(Entities\Rule $rule, Entities\Whitelist $whitelist)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @return Entities\Rule
     */
    public function getRule(Entities\Rule $rule)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @param Entities\Rule $rule
     * @return Entities\Rule
     */
    public function updateRule(Entities\Rule $originalRule, Entities\Rule $updatedRule)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @return null
     */
    public function deleteRule(Entities\Rule $rule)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Rule $rule
     * @return Entities\Rule
     */
    public function createRule(Entities\Rule $rule)
    {
        //TODO: generated_code
    }
}
