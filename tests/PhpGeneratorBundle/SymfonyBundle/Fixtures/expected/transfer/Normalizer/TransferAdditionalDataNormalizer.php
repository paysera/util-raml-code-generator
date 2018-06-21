<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Evp\Component\Money\MoneyNormalizer;
use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferAdditionalData;

class TransferAdditionalDataNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $outCommissionRuleNormalizer;
    private $moneyNormalizer;
    
    public function __construct(
        OutCommissionRuleNormalizer $outCommissionRuleNormalizer,
        MoneyNormalizer $moneyNormalizer
    ) {
        $this->outCommissionRuleNormalizer = $outCommissionRuleNormalizer;
        $this->moneyNormalizer = $moneyNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return TransferAdditionalData
     */
    public function mapToEntity($data)
    {
        $entity = new TransferAdditionalData();

        if (isset($data['estimated_processing_date'])) {
            $entity->setEstimatedProcessingDate((new \DateTime())->setTimestamp($data['estimated_processing_date']));
        }
        if (isset($data['out_commission_rule'])) {
            $entity->setOutCommissionRule($this->outCommissionRuleNormalizer->mapToEntity($data['out_commission_rule']));
        }
        if (isset($data['original_out_commission'])) {
            $entity->setOriginalOutCommission($this->moneyNormalizer->mapToEntity($data['original_out_commission']));
        }
        if (isset($data['correspondent_bank_fees_may_apply'])) {
            $entity->setCorrespondentBankFeesMayApply($data['correspondent_bank_fees_may_apply']);
        }
        
        return $entity;
    }

    /**
     * @param TransferAdditionalData $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'estimated_processing_date' => $entity->getEstimatedProcessingDate() !== null ? $entity->getEstimatedProcessingDate()->getTimestamp() : null,
            'out_commission_rule' => $entity->getOutCommissionRule() !== null ? $this->outCommissionRuleNormalizer->mapFromEntity($entity->getOutCommissionRule()) : null,
            'original_out_commission' => $entity->getOriginalOutCommission() !== null ? $this->moneyNormalizer->mapFromEntity($entity->getOriginalOutCommission()) : null,
            'correspondent_bank_fees_may_apply' => $entity->isCorrespondentBankFeesMayApply(),
            
        ];
    }
}
