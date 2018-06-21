<?php

namespace Vendor\Test\CategoryApiBundle\Voter;

use Vendor\Test\CategoryApiBundle\CategoryPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class CategoryScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            CategoryPermissions::GET_CATEGORIES => [
                // TODO: generated_code
            ],
            CategoryPermissions::CREATE_CATEGORY => [
                // TODO: generated_code
            ],
            CategoryPermissions::UPDATE_CATEGORY => [
                // TODO: generated_code
            ],
            CategoryPermissions::DELETE_CATEGORY => [
                // TODO: generated_code
            ],
            CategoryPermissions::ENABLE_CATEGORY => [
                // TODO: generated_code
            ],
            CategoryPermissions::DISABLE_CATEGORY => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
