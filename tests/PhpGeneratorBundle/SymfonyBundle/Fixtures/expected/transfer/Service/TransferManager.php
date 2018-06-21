<?php

namespace Vendor\Test\TransferApiBundle\Service;

use Vendor\Test\TransferApiBundle\Entity as Entities;
use Vendor\Test\TransferApiBundle\Repository\TransferRepository;
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
     * @param Entities\TransferInput $transferInput
     * @param Entities\TransferRegistrationParameters $transferRegistrationParameters
     * @return Entities\TransferOutput
     */
    public function signTransfer(Entities\TransferInput $transferInput, Entities\TransferRegistrationParameters $transferRegistrationParameters)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\TransferInput $transferInput
     * @param Entities\TransferRegistrationParameters $transferRegistrationParameters
     * @return Entities\TransferOutput
     */
    public function reserveTransfer(Entities\TransferInput $transferInput, Entities\TransferRegistrationParameters $transferRegistrationParameters)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\TransferInput $transferInput
     * @param Entities\TransferPassword $transferPassword
     * @return Entities\TransferOutput
     */
    public function provideTransferPassword(Entities\TransferInput $transferInput, Entities\TransferPassword $transferPassword)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\TransferInput $transferInput
     * @return Entities\TransferOutput
     */
    public function freezeTransfer(Entities\TransferInput $transferInput)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\TransferInput $transferInput
     * @return Entities\TransferOutput
     */
    public function completeTransfer(Entities\TransferInput $transferInput)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\TransferInput $transferInput
     * @param Entities\TransferRegistrationParameters $transferRegistrationParameters
     * @return Entities\TransferOutput
     */
    public function registerTransfer(Entities\TransferInput $transferInput, Entities\TransferRegistrationParameters $transferRegistrationParameters)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\TransferInput $transferInput
     * @return Entities\TransferOutput
     */
    public function getTransfer(Entities\TransferInput $transferInput)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\TransferInput $transferInput
     * @return Entities\TransferOutput
     */
    public function deleteTransfer(Entities\TransferInput $transferInput)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\TransfersBatch $transfersBatch
     * @return Entities\TransfersBatchResult
     */
    public function reserveTransfers(Entities\TransfersBatch $transfersBatch)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\TransferInput $transferInput
     * @return Entities\TransferOutput
     */
    public function createTransfer(Entities\TransferInput $transferInput)
    {
        //TODO: generated_code
    }
}
