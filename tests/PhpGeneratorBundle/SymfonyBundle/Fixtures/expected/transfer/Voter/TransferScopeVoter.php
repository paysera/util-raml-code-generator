<?php

namespace Vendor\Test\TransferApiBundle\Voter;

use Vendor\Test\TransferApiBundle\TransferPermissions;
use Paysera\Bundle\SecurityBundle\Security\ContextAwareScopeVoter;
use Paysera\Bundle\SecurityBundle\Entity\AccessedBy;

class TransferScopeVoter extends ContextAwareScopeVoter
{
    public function getPermissionScopeMap()
    {
        return [
            TransferPermissions::CREATE_TRANSFER => [
                // TODO: generated_code
            ],
            TransferPermissions::GET_TRANSFER => [
                // TODO: generated_code
            ],
            TransferPermissions::DELETE_TRANSFER => [
                // TODO: generated_code
            ],
            TransferPermissions::SIGN_TRANSFER => [
                // TODO: generated_code
            ],
            TransferPermissions::RESERVE_TRANSFER => [
                // TODO: generated_code
            ],
            TransferPermissions::PROVIDE_TRANSFER_PASSWORD => [
                // TODO: generated_code
            ],
            TransferPermissions::FREEZE_TRANSFER => [
                // TODO: generated_code
            ],
            TransferPermissions::COMPLETE_TRANSFER => [
                // TODO: generated_code
            ],
            TransferPermissions::REGISTER_TRANSFER => [
                // TODO: generated_code
            ],
            TransferPermissions::GET_TRANSFERS => [
                // TODO: generated_code
            ],
            TransferPermissions::RESERVE_TRANSFERS => [
                // TODO: generated_code
            ],
        ];
    }

    public function checkAccessRights(AccessedBy $accessedBy, $permission, $subject)
    {
        // TODO: generated_code
    }
}
