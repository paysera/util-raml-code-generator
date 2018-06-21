<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Evp\Component\Money\MoneyNormalizer;
use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferInput;

class TransferInputNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $moneyNormalizer;
    private $transferBeneficiaryNormalizer;
    private $payerNormalizer;
    private $finalBeneficiaryNormalizer;
    private $transferNotificationsNormalizer;
    private $transferPurposeNormalizer;
    private $transferPassword34Normalizer;
    
    public function __construct(
        MoneyNormalizer $moneyNormalizer,
        TransferBeneficiaryNormalizer $transferBeneficiaryNormalizer,
        PayerNormalizer $payerNormalizer,
        FinalBeneficiaryNormalizer $finalBeneficiaryNormalizer,
        TransferNotificationsNormalizer $transferNotificationsNormalizer,
        TransferPurposeNormalizer $transferPurposeNormalizer,
        TransferPassword34Normalizer $transferPassword34Normalizer
    ) {
        $this->moneyNormalizer = $moneyNormalizer;
        $this->transferBeneficiaryNormalizer = $transferBeneficiaryNormalizer;
        $this->payerNormalizer = $payerNormalizer;
        $this->finalBeneficiaryNormalizer = $finalBeneficiaryNormalizer;
        $this->transferNotificationsNormalizer = $transferNotificationsNormalizer;
        $this->transferPurposeNormalizer = $transferPurposeNormalizer;
        $this->transferPassword34Normalizer = $transferPassword34Normalizer;
    }
    
    /**
     * @param array $data
     *
     * @return TransferInput
     */
    public function mapToEntity($data)
    {
        $entity = new TransferInput();

        if (isset($data['amount'])) {
            $entity->setAmount($this->moneyNormalizer->mapToEntity($data['amount']));
        }
        if (isset($data['beneficiary'])) {
            $entity->setBeneficiary($this->transferBeneficiaryNormalizer->mapToEntity($data['beneficiary']));
        }
        if (isset($data['payer'])) {
            $entity->setPayer($this->payerNormalizer->mapToEntity($data['payer']));
        }
        if (isset($data['final_beneficiary'])) {
            $entity->setFinalBeneficiary($this->finalBeneficiaryNormalizer->mapToEntity($data['final_beneficiary']));
        }
        if (isset($data['perform_at'])) {
            $entity->setPerformAt((new \DateTime())->setTimestamp($data['perform_at']));
        }
        if (isset($data['charge_type'])) {
            $entity->setChargeType($data['charge_type']);
        }
        if (isset($data['urgency'])) {
            $entity->setUrgency($data['urgency']);
        }
        if (isset($data['notifications'])) {
            $entity->setNotifications($this->transferNotificationsNormalizer->mapToEntity($data['notifications']));
        }
        if (isset($data['purpose'])) {
            $entity->setPurpose($this->transferPurposeNormalizer->mapToEntity($data['purpose']));
        }
        if (isset($data['password'])) {
            $entity->setPassword($this->transferPassword34Normalizer->mapToEntity($data['password']));
        }
        if (isset($data['cancelable'])) {
            $entity->setCancelable($data['cancelable']);
        }
        if (isset($data['auto_currency_convert'])) {
            $entity->setAutoCurrencyConvert($data['auto_currency_convert']);
        }
        if (isset($data['auto_charge_related_card'])) {
            $entity->setAutoChargeRelatedCard($data['auto_charge_related_card']);
        }
        if (isset($data['reserve_until'])) {
            $entity->setReserveUntil((new \DateTime())->setTimestamp($data['reserve_until']));
        }
        
        return $entity;
    }

    /**
     * @param TransferInput $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'amount' => $entity->getAmount() !== null ? $this->moneyNormalizer->mapFromEntity($entity->getAmount()) : null,
            'beneficiary' => $entity->getBeneficiary() !== null ? $this->transferBeneficiaryNormalizer->mapFromEntity($entity->getBeneficiary()) : null,
            'payer' => $entity->getPayer() !== null ? $this->payerNormalizer->mapFromEntity($entity->getPayer()) : null,
            'final_beneficiary' => $entity->getFinalBeneficiary() !== null ? $this->finalBeneficiaryNormalizer->mapFromEntity($entity->getFinalBeneficiary()) : null,
            'perform_at' => $entity->getPerformAt() !== null ? $entity->getPerformAt()->getTimestamp() : null,
            'charge_type' => $entity->getChargeType(),
            'urgency' => $entity->getUrgency(),
            'notifications' => $entity->getNotifications() !== null ? $this->transferNotificationsNormalizer->mapFromEntity($entity->getNotifications()) : null,
            'purpose' => $entity->getPurpose() !== null ? $this->transferPurposeNormalizer->mapFromEntity($entity->getPurpose()) : null,
            'password' => $entity->getPassword() !== null ? $this->transferPassword34Normalizer->mapFromEntity($entity->getPassword()) : null,
            'cancelable' => $entity->isCancelable(),
            'auto_currency_convert' => $entity->isAutoCurrencyConvert(),
            'auto_charge_related_card' => $entity->isAutoChargeRelatedCard(),
            'reserve_until' => $entity->getReserveUntil() !== null ? $entity->getReserveUntil()->getTimestamp() : null,
            
        ];
    }
}
