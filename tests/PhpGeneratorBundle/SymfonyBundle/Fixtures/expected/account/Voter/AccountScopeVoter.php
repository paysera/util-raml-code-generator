<?php

namespace Vendor\Test\AccountApiBundle\Voter;

use Vendor\Test\AccountApiBundle\AccountPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class AccountScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            AccountPermissions::GET_ACCOUNTS => [
                // TODO: generated_code
            ],
            AccountPermissions::GET_ACCOUNT_SCRIPTS => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
