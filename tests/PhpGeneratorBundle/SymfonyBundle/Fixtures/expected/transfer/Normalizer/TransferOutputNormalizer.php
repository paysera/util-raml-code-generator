<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Evp\Component\Money\MoneyNormalizer;
use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferOutput;

class TransferOutputNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $transferInitiatorNormalizer;
    private $transferFailureStatusNormalizer;
    private $moneyNormalizer;
    private $transferAdditionalDataNormalizer;
    
    public function __construct(
        TransferInitiatorNormalizer $transferInitiatorNormalizer,
        TransferFailureStatusNormalizer $transferFailureStatusNormalizer,
        MoneyNormalizer $moneyNormalizer,
        TransferAdditionalDataNormalizer $transferAdditionalDataNormalizer
    ) {
        $this->transferInitiatorNormalizer = $transferInitiatorNormalizer;
        $this->transferFailureStatusNormalizer = $transferFailureStatusNormalizer;
        $this->moneyNormalizer = $moneyNormalizer;
        $this->transferAdditionalDataNormalizer = $transferAdditionalDataNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return TransferOutput
     */
    public function mapToEntity($data)
    {
        $entity = new TransferOutput();

        if (isset($data['status'])) {
            $entity->setStatus($data['status']);
        }
        if (isset($data['initiator'])) {
            $entity->setInitiator($this->transferInitiatorNormalizer->mapToEntity($data['initiator']));
        }
        if (isset($data['created_at'])) {
            $entity->setCreatedAt((new \DateTime())->setTimestamp($data['created_at']));
        }
        if (isset($data['performed_at'])) {
            $entity->setPerformedAt((new \DateTime())->setTimestamp($data['performed_at']));
        }
        if (isset($data['failure_status'])) {
            $entity->setFailureStatus($this->transferFailureStatusNormalizer->mapToEntity($data['failure_status']));
        }
        if (isset($data['out_commission'])) {
            $entity->setOutCommission($this->moneyNormalizer->mapToEntity($data['out_commission']));
        }
        if (isset($data['additional_information'])) {
            $entity->setAdditionalInformation($this->transferAdditionalDataNormalizer->mapToEntity($data['additional_information']));
        }
        
        return $entity;
    }

    /**
     * @param TransferOutput $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'status' => $entity->getStatus(),
            'initiator' => $entity->getInitiator() !== null ? $this->transferInitiatorNormalizer->mapFromEntity($entity->getInitiator()) : null,
            'created_at' => $entity->getCreatedAt()->getTimestamp(),
            'performed_at' => $entity->getPerformedAt() !== null ? $entity->getPerformedAt()->getTimestamp() : null,
            'failure_status' => $entity->getFailureStatus() !== null ? $this->transferFailureStatusNormalizer->mapFromEntity($entity->getFailureStatus()) : null,
            'out_commission' => $entity->getOutCommission() !== null ? $this->moneyNormalizer->mapFromEntity($entity->getOutCommission()) : null,
            'additional_information' => $entity->getAdditionalInformation() !== null ? $this->transferAdditionalDataNormalizer->mapFromEntity($entity->getAdditionalInformation()) : null,
            
        ];
    }
}
