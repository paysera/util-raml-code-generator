<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\UserRiskLevelApiBundle\Entity\RiskRule;

class RiskRuleNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return RiskRule
     */
    public function mapToEntity($data)
    {
        $entity = new RiskRule();

        if (isset($data['name'])) {
            $entity->setName($data['name']);
        }
        if (isset($data['applied'])) {
            $entity->setApplied($data['applied']);
        }
        
        return $entity;
    }

    /**
     * @param RiskRule $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'applied' => $entity->isApplied(),
            
        ];
    }
}
