<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Voter;

use Vendor\Test\TransferSurveillanceApiBundle\CriterionPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class CriterionScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            CriterionPermissions::GET_CRITERIAS => [
                // TODO: generated_code
            ],
            CriterionPermissions::CREATE_CRITERION => [
                // TODO: generated_code
            ],
            CriterionPermissions::DELETE_CRITERION => [
                // TODO: generated_code
            ],
            CriterionPermissions::GET_CRITERION => [
                // TODO: generated_code
            ],
            CriterionPermissions::UPDATE_CRITERION => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
