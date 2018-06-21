<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\UserRiskLevelApiBundle\Entity\ManualRule;

class ManualRuleNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return ManualRule
     */
    public function mapToEntity($data)
    {
        $entity = new ManualRule();

        if (isset($data['name'])) {
            $entity->setName($data['name']);
        }
        if (isset($data['user_id'])) {
            $entity->setUserId($data['user_id']);
        }
        
        return $entity;
    }

    /**
     * @param ManualRule $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'user_id' => $entity->getUserId(),
            
        ];
    }
}
