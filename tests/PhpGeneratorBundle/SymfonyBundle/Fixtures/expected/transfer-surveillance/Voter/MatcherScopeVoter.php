<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Voter;

use Vendor\Test\TransferSurveillanceApiBundle\MatcherPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class MatcherScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            MatcherPermissions::GET_MATCHERS => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
