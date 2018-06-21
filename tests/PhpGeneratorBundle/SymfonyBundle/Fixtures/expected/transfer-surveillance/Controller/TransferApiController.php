<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Controller;

use Vendor\Test\TransferSurveillanceApiBundle\Entity as Entities;
use Vendor\Test\TransferSurveillanceApiBundle\Service\TransferManager;
use Vendor\Test\TransferSurveillanceApiBundle\TransferPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class TransferApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $transferManager;
    
    public function __construct(
        TransferManager $transferManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->transferManager = $transferManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Mark Inspection as accepted. Allow transfer to complete
     * PUT /transfer/inspection/{transferId}/accept
     *
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function acceptTransferInspection($transferId, Entities\Review $review)
    {
        $this->authorizationChecker->check(TransferPermissions::ACCEPT_TRANSFER_INSPECTION);
        $this->transferManager->acceptTransferInspection($transferId, $review);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Mark Inspection as cancelled/rejected. Do not allow the transfer to complete
     * PUT /transfer/inspection/{transferId}/cancel
     *
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function cancelTransferInspection($transferId, Entities\Review $review)
    {
        $this->authorizationChecker->check(TransferPermissions::CANCEL_TRANSFER_INSPECTION);
        $this->transferManager->cancelTransferInspection($transferId, $review);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Mark Inspection as audited.
     * PUT /transfer/inspection/{transferId}/audit
     *
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function auditTransferInspection($transferId, Entities\Review $review)
    {
        $this->authorizationChecker->check(TransferPermissions::AUDIT_TRANSFER_INSPECTION);
        $this->transferManager->auditTransferInspection($transferId, $review);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Mark Inspection as need additional info from user about the transfer.
     * PUT /transfer/inspection/{transferId}/request-user-info
     *
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function requestTransferInspectionUserInfo($transferId, Entities\Review $review)
    {
        $this->authorizationChecker->check(TransferPermissions::REQUEST_TRANSFER_INSPECTION_USER_INFO);
        $this->transferManager->requestTransferInspectionUserInfo($transferId, $review);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Mark Inspection as received additional info from user about the transfer.
     * PUT /transfer/inspection/{transferId}/receive-user-info
     *
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function receiveTransferInspectionUserInfo($transferId, Entities\Review $review)
    {
        $this->authorizationChecker->check(TransferPermissions::RECEIVE_TRANSFER_INSPECTION_USER_INFO);
        $this->transferManager->receiveTransferInspectionUserInfo($transferId, $review);
        $this->entityManager->flush();
        return null;
    }
}
