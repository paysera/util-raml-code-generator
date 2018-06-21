<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Normalizer;

use Evp\Component\Money\MoneyNormalizer;
use Paysera\Component\Serializer\Normalizer\ArrayNormalizer;
use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferSurveillanceApiBundle\Entity\Whitelist;

class WhitelistNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $moneyNormalizer;
    private $profilesNormalizer;
    
    public function __construct(
        MoneyNormalizer $moneyNormalizer,
        ArrayNormalizer $profilesNormalizer
    ) {
        $this->moneyNormalizer = $moneyNormalizer;
        $this->profilesNormalizer = $profilesNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return Whitelist
     */
    public function mapToEntity($data)
    {
        $entity = new Whitelist();

        if (isset($data['payer_covenantee_id'])) {
            $entity->setPayerCovenanteeId($data['payer_covenantee_id']);
        }
        if (isset($data['payer_account_identifier'])) {
            $entity->setPayerAccountIdentifier($data['payer_account_identifier']);
        }
        if (isset($data['beneficiary_covenantee_id'])) {
            $entity->setBeneficiaryCovenanteeId($data['beneficiary_covenantee_id']);
        }
        if (isset($data['beneficiary_account_identifier'])) {
            $entity->setBeneficiaryAccountIdentifier($data['beneficiary_account_identifier']);
        }
        if (isset($data['max_amount'])) {
            $entity->setMaxAmount($this->moneyNormalizer->mapToEntity($data['max_amount']));
        }
        if (isset($data['profiles'])) {
            $entity->setProfiles($this->profilesNormalizer->mapToEntity($data['profiles']));
        }
        
        return $entity;
    }

    /**
     * @param Whitelist $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'payer_covenantee_id' => $entity->getPayerCovenanteeId(),
            'payer_account_identifier' => $entity->getPayerAccountIdentifier(),
            'beneficiary_covenantee_id' => $entity->getBeneficiaryCovenanteeId(),
            'beneficiary_account_identifier' => $entity->getBeneficiaryAccountIdentifier(),
            'max_amount' => $entity->getMaxAmount() !== null ? $this->moneyNormalizer->mapFromEntity($entity->getMaxAmount()) : null,
            'profiles' => $this->profilesNormalizer->mapFromEntity($entity->getProfiles()),
            
        ];
    }
}
