<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Voter;

use Vendor\Test\UserRiskLevelApiBundle\ManualRulePermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class ManualRuleScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            ManualRulePermissions::GET_MANUAL_RULES => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
