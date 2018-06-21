<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\ArrayNormalizer;
use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\UserRiskLevelApiBundle\Entity\RiskLevel;

class RiskLevelNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $riskRulesNormalizer;
    
    public function __construct(
        ArrayNormalizer $riskRulesNormalizer
    ) {
        $this->riskRulesNormalizer = $riskRulesNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return RiskLevel
     */
    public function mapToEntity($data)
    {
        $entity = new RiskLevel();

        if (isset($data['user_id'])) {
            $entity->setUserId($data['user_id']);
        }
        if (isset($data['level'])) {
            $entity->setLevel($data['level']);
        }
        if (isset($data['calculated_at'])) {
            $entity->setCalculatedAt((new \DateTime())->setTimestamp($data['calculated_at']));
        }
        if (isset($data['risk_rules'])) {
            $entity->setRiskRules($this->riskRulesNormalizer->mapToEntity($data['risk_rules']));
        }
        
        return $entity;
    }

    /**
     * @param RiskLevel $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'user_id' => $entity->getUserId(),
            'level' => $entity->getLevel(),
            'calculated_at' => $entity->getCalculatedAt()->getTimestamp(),
            'risk_rules' => $this->riskRulesNormalizer->mapFromEntity($entity->getRiskRules()),
            
        ];
    }
}
