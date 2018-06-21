<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\UserRiskLevelApiBundle\Entity\AuditableManualRule;

class AuditableManualRuleNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $manualRuleNormalizer;
    private $auditRecordNormalizer;
    
    public function __construct(
        ManualRuleNormalizer $manualRuleNormalizer,
        AuditRecordNormalizer $auditRecordNormalizer
    ) {
        $this->manualRuleNormalizer = $manualRuleNormalizer;
        $this->auditRecordNormalizer = $auditRecordNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return AuditableManualRule
     */
    public function mapToEntity($data)
    {
        $entity = new AuditableManualRule();

        if (isset($data['manual_rule'])) {
            $entity->setManualRule($this->manualRuleNormalizer->mapToEntity($data['manual_rule']));
        }
        if (isset($data['audit_record'])) {
            $entity->setAuditRecord($this->auditRecordNormalizer->mapToEntity($data['audit_record']));
        }
        
        return $entity;
    }

    /**
     * @param AuditableManualRule $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'manual_rule' => $entity->getManualRule() !== null ? $this->manualRuleNormalizer->mapFromEntity($entity->getManualRule()) : null,
            'audit_record' => $entity->getAuditRecord() !== null ? $this->auditRecordNormalizer->mapFromEntity($entity->getAuditRecord()) : null,
            
        ];
    }
}
