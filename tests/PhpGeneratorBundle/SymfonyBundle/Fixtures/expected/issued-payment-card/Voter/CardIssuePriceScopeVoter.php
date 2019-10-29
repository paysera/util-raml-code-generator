<?php

namespace Vendor\Test\IssuedPaymentCardApiBundle\Voter;

use Vendor\Test\IssuedPaymentCardApiBundle\CardIssuePricePermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class CardIssuePriceScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            CardIssuePricePermissions::GET_CARD_ISSUE_PRICE => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
