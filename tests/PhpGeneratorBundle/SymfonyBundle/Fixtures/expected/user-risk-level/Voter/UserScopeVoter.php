<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Voter;

use Vendor\Test\UserRiskLevelApiBundle\UserPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class UserScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            UserPermissions::GET_USER_RISK_LEVEL => [
                // TODO: generated_code
            ],
            UserPermissions::GET_USER_MANUAL_RULES => [
                // TODO: generated_code
            ],
            UserPermissions::CREATE_USER_MANUAL_RULE => [
                // TODO: generated_code
            ],
            UserPermissions::DELETE_USER_MANUAL_RULE => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
