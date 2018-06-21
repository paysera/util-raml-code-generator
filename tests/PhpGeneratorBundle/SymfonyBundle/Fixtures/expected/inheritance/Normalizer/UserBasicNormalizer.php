<?php

namespace Vendor\Test\InheritanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\InheritanceApiBundle\Entity\UserBasic;

class UserBasicNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return UserBasic
     */
    public function mapToEntity($data)
    {
        $entity = new UserBasic();

        if (isset($data['type'])) {
            $entity->setType($data['type']);
        }
        
        return $entity;
    }

    /**
     * @param UserBasic $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'type' => $entity->getType(),
            
        ];
    }
}
