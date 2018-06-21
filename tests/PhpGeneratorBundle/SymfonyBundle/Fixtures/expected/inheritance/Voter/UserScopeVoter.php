<?php

namespace Vendor\Test\InheritanceApiBundle\Voter;

use Vendor\Test\InheritanceApiBundle\UserPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class UserScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            UserPermissions::GET_USERS => [
                // TODO: generated_code
            ],
            UserPermissions::CREATE_USER => [
                // TODO: generated_code
            ],
            UserPermissions::GET_USER_NATURAL => [
                // TODO: generated_code
            ],
            UserPermissions::CREATE_NATURAL_USER => [
                // TODO: generated_code
            ],
            UserPermissions::GET_USER_LEGAL => [
                // TODO: generated_code
            ],
            UserPermissions::CREATE_LEGAL_USER => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
