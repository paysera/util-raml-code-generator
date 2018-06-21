<?php

namespace Vendor\Test\AccountApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\AccountApiBundle\Entity\UndescribedType;

class UndescribedTypeNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return UndescribedType
     */
    public function mapToEntity($data)
    {
        $entity = new UndescribedType();

        if (isset($data['age'])) {
            $entity->setAge($data['age']);
        }
        if (isset($data['name'])) {
            $entity->setName($data['name']);
        }
        
        return $entity;
    }

    /**
     * @param UndescribedType $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'age' => $entity->getAge(),
            'name' => $entity->getName(),
            
        ];
    }
}
