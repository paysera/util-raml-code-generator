<?php

namespace Vendor\Test\InheritanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\InheritanceApiBundle\Entity\UserNatural;

class UserNaturalNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return UserNatural
     */
    public function mapToEntity($data)
    {
        $entity = new UserNatural();

        if (isset($data['name'])) {
            $entity->setName($data['name']);
        }
        if (isset($data['surname'])) {
            $entity->setSurname($data['surname']);
        }
        
        return $entity;
    }

    /**
     * @param UserNatural $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'surname' => $entity->getSurname(),
            
        ];
    }
}
