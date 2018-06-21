<?php

namespace Vendor\Test\TransferApiBundle\Controller;

use Vendor\Test\TransferApiBundle\Entity as Entities;
use Paysera\Component\Serializer\Entity\Result;
use Vendor\Test\TransferApiBundle\Service\TransferManager;
use Paysera\Bundle\RestBundle\Repository\ResultProvider;
use Vendor\Test\TransferApiBundle\TransferPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class TransferApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $transferManager;
    private $transferResultProvider;
    
    public function __construct(
        TransferManager $transferManager,
        ResultProvider $transferResultProvider,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->transferManager = $transferManager;
        $this->transferResultProvider = $transferResultProvider;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Sign the transfer, even if no funds available.
     * PUT /transfer/{id}/sign
     *
     * @param Entities\TransferInput $transferInput
     * @param Entities\TransferRegistrationParameters $transferRegistrationParameters
     * @return Entities\TransferOutput
     */
    public function signTransfer(Entities\TransferInput $transferInput, Entities\TransferRegistrationParameters $transferRegistrationParameters)
    {
        $this->authorizationChecker->check(TransferPermissions::SIGN_TRANSFER);
        $result = $this->transferManager->signTransfer($transferInput, $transferRegistrationParameters);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Sign and reserve money for transfer. Returns error if no funds available.
     * PUT /transfer/{id}/reserve
     *
     * @param Entities\TransferInput $transferInput
     * @param Entities\TransferRegistrationParameters $transferRegistrationParameters
     * @return Entities\TransferOutput
     */
    public function reserveTransfer(Entities\TransferInput $transferInput, Entities\TransferRegistrationParameters $transferRegistrationParameters)
    {
        $this->authorizationChecker->check(TransferPermissions::RESERVE_TRANSFER);
        $result = $this->transferManager->reserveTransfer($transferInput, $transferRegistrationParameters);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Provide password for Transfer. Available only for internal transfers.
     * PUT /transfer/{id}/provide-password
     *
     * @param Entities\TransferInput $transferInput
     * @param Entities\TransferPassword $transferPassword
     * @return Entities\TransferOutput
     */
    public function provideTransferPassword(Entities\TransferInput $transferInput, Entities\TransferPassword $transferPassword)
    {
        $this->authorizationChecker->check(TransferPermissions::PROVIDE_TRANSFER_PASSWORD);
        $result = $this->transferManager->provideTransferPassword($transferInput, $transferPassword);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Freeze transfer. Available only for `reserved` transfers. Same as completing transfer but beneficiary cannot spend funds - they are reserved. Revoking transfer is possible after freezing.
     * PUT /transfer/{id}/freeze
     *
     * @param Entities\TransferInput $transferInput
     * @return Entities\TransferOutput
     */
    public function freezeTransfer(Entities\TransferInput $transferInput)
    {
        $this->authorizationChecker->check(TransferPermissions::FREEZE_TRANSFER);
        $result = $this->transferManager->freezeTransfer($transferInput);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Complete transfer. Available for `reserved` and `freezed` transfers.
     * PUT /transfer/{id}/complete
     *
     * @param Entities\TransferInput $transferInput
     * @return Entities\TransferOutput
     */
    public function completeTransfer(Entities\TransferInput $transferInput)
    {
        $this->authorizationChecker->check(TransferPermissions::COMPLETE_TRANSFER);
        $result = $this->transferManager->completeTransfer($transferInput);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Make transfer visible in frontend for signing. If currency convert operations are related to transfer, they are done when transfer becomes `reserved`. If there are expectations in currency convert requests, transfer becomes `failed` together with related conversion request(s) if those expectations fails.
     * PUT /transfer/{id}/register
     *
     * @param Entities\TransferInput $transferInput
     * @param Entities\TransferRegistrationParameters $transferRegistrationParameters
     * @return Entities\TransferOutput
     */
    public function registerTransfer(Entities\TransferInput $transferInput, Entities\TransferRegistrationParameters $transferRegistrationParameters)
    {
        $this->authorizationChecker->check(TransferPermissions::REGISTER_TRANSFER);
        $result = $this->transferManager->registerTransfer($transferInput, $transferRegistrationParameters);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Get transfer.
     * GET /transfer/{id}
     *
     * @param Entities\TransferInput $transferInput
     * @return Entities\TransferOutput
     */
    public function getTransfer(Entities\TransferInput $transferInput)
    {
        $this->authorizationChecker->check(TransferPermissions::GET_TRANSFER);
        return $this->transferManager->getTransfer($transferInput);
    }
    /**
     * Revoke transfer.
     * DELETE /transfer/{id}
     *
     * @param Entities\TransferInput $transferInput
     * @return Entities\TransferOutput
     */
    public function deleteTransfer(Entities\TransferInput $transferInput)
    {
        $this->authorizationChecker->check(TransferPermissions::DELETE_TRANSFER);
        $result = $this->transferManager->deleteTransfer($transferInput);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Reserve all transfers in a transaction. Possibly revoke other given transfers in same transaction. Possibly make currency convertions in in same transaction.
     * PUT /transfers/reserve
     *
     * @param Entities\TransfersBatch $transfersBatch
     * @return Entities\TransfersBatchResult
     */
    public function reserveTransfers(Entities\TransfersBatch $transfersBatch)
    {
        $this->authorizationChecker->check(TransferPermissions::RESERVE_TRANSFERS);
        $result = $this->transferManager->reserveTransfers($transfersBatch);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Standard SQL-style Result filtering
     * GET /transfers
     *
     * @param Entities\TransfersFilter $transfersFilter
     * @return Result|Entities\TransferOutput[]
     */
    public function getTransfers(Entities\TransfersFilter $transfersFilter)
    {
        $this->authorizationChecker->check(TransferPermissions::GET_TRANSFERS);
        return $this->transferResultProvider->getResult($transfersFilter);
    }
    /**
     * Create transfer in the system. Created transfer is invisible and will be deleted if no more actions are performed.

     * POST /transfer
     *
     * @param Entities\TransferInput $transferInput
     * @return Entities\TransferOutput
     */
    public function createTransfer(Entities\TransferInput $transferInput)
    {
        $this->authorizationChecker->check(TransferPermissions::CREATE_TRANSFER);
        $result = $this->transferManager->createTransfer($transferInput);
        $this->entityManager->flush();
        return $result;
    }
}
