<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Voter;

use Vendor\Test\TransferSurveillanceApiBundle\TransferPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class TransferScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            TransferPermissions::ACCEPT_TRANSFER_INSPECTION => [
                // TODO: generated_code
            ],
            TransferPermissions::CANCEL_TRANSFER_INSPECTION => [
                // TODO: generated_code
            ],
            TransferPermissions::AUDIT_TRANSFER_INSPECTION => [
                // TODO: generated_code
            ],
            TransferPermissions::REQUEST_TRANSFER_INSPECTION_USER_INFO => [
                // TODO: generated_code
            ],
            TransferPermissions::RECEIVE_TRANSFER_INSPECTION_USER_INFO => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
