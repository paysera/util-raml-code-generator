<?php

namespace Vendor\Test\CustomApiBundle\Voter;

use Vendor\Test\CustomApiBundle\SomethingPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class SomethingScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            SomethingPermissions::CUSTOM_NAME_FOR_METHOD => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
