<?php

namespace Vendor\Test\AuthApiBundle\Voter;

use Vendor\Test\AuthApiBundle\TokenPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class TokenScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            TokenPermissions::CREATE_AUTH_TOKEN => [
                // TODO: generated_code
            ],
            TokenPermissions::DELETE_AUTH_TOKEN => [
                // TODO: generated_code
            ],
            TokenPermissions::CREATE_OPTIONAL_SYSTEM_TOKEN => [
                // TODO: generated_code
            ],
            TokenPermissions::CREATE_STRICT_SYSTEM_TOKEN => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
