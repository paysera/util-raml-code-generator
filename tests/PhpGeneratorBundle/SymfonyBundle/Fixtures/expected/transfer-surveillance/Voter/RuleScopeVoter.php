<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Voter;

use Vendor\Test\TransferSurveillanceApiBundle\RulePermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class RuleScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            RulePermissions::GET_RULES => [
                // TODO: generated_code
            ],
            RulePermissions::CREATE_RULE => [
                // TODO: generated_code
            ],
            RulePermissions::GET_RULE => [
                // TODO: generated_code
            ],
            RulePermissions::UPDATE_RULE => [
                // TODO: generated_code
            ],
            RulePermissions::DELETE_RULE => [
                // TODO: generated_code
            ],
            RulePermissions::ENABLE_RULE => [
                // TODO: generated_code
            ],
            RulePermissions::DISABLE_RULE => [
                // TODO: generated_code
            ],
            RulePermissions::GET_RULE_WHITELISTS => [
                // TODO: generated_code
            ],
            RulePermissions::CREATE_RULE_WHITELIST => [
                // TODO: generated_code
            ],
            RulePermissions::GET_RULE_WHITELIST => [
                // TODO: generated_code
            ],
            RulePermissions::UPDATE_RULE_WHITELIST => [
                // TODO: generated_code
            ],
            RulePermissions::DELETE_RULE_WHITELIST => [
                // TODO: generated_code
            ],
            RulePermissions::GET_RULE_WHITELIST_PROFILE_LIST => [
                // TODO: generated_code
            ],
            RulePermissions::UPDATE_RULE_WHITELIST_PROFILE_LIST => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
