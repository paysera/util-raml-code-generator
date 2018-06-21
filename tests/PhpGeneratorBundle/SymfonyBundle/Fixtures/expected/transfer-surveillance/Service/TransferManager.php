<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Service;

use Vendor\Test\TransferSurveillanceApiBundle\Entity as Entities;
use Vendor\Test\TransferSurveillanceApiBundle\Repository\TransferRepository;
use Doctrine\ORM\EntityManager;

class TransferManager
{
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function acceptTransferInspection($transferId, Entities\Review $review)
    {
        //TODO: generated_code
    }
    /**
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function cancelTransferInspection($transferId, Entities\Review $review)
    {
        //TODO: generated_code
    }
    /**
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function auditTransferInspection($transferId, Entities\Review $review)
    {
        //TODO: generated_code
    }
    /**
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function requestTransferInspectionUserInfo($transferId, Entities\Review $review)
    {
        //TODO: generated_code
    }
    /**
     * @param string $transferId
     * @param Entities\Review $review
     * @return null
     */
    public function receiveTransferInspectionUserInfo($transferId, Entities\Review $review)
    {
        //TODO: generated_code
    }
}
