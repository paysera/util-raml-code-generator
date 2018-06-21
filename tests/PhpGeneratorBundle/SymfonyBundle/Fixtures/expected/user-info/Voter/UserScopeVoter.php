<?php

namespace Vendor\Test\UserInfoApiBundle\Voter;

use Vendor\Test\UserInfoApiBundle\UserPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class UserScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            UserPermissions::CREATE_LEGAL_USER => [
                // TODO: generated_code
            ],
            UserPermissions::CREATE_NATURAL_USER => [
                // TODO: generated_code
            ],
            UserPermissions::GET_USER_INFORMATION => [
                // TODO: generated_code
            ],
            UserPermissions::UPDATE_USER_INFORMATION => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
