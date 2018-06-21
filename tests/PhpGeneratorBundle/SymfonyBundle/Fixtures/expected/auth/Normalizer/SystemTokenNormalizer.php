<?php

namespace Vendor\Test\AuthApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\AuthApiBundle\Entity\SystemToken;

class SystemTokenNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return SystemToken
     */
    public function mapToEntity($data)
    {
        $entity = new SystemToken();

        if (isset($data['value'])) {
            $entity->setValue($data['value']);
        }
        
        return $entity;
    }

    /**
     * @param SystemToken $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'value' => $entity->getValue(),
            
        ];
    }
}
