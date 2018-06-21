<?php

namespace Vendor\Test\CategoryApiBundle\Voter;

use Vendor\Test\CategoryApiBundle\KeywordPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class KeywordScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            KeywordPermissions::GET_KEYWORDS => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
