<?php

namespace Vendor\Test\InheritanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\InheritanceApiBundle\Entity\UserNaturalFilter;

class UserNaturalFilterNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param array $data
     *
     * @return UserNaturalFilter
     */
    public function mapToEntity($data)
    {
        $entity = new UserNaturalFilter();
        if (isset($data['first_name'])) {
            $entity->setFirstName($data['first_name']);
        }
        if (isset($data['last_name'])) {
            $entity->setLastName($data['last_name']);
        }
        
        return $entity;
    }

    /**
     * @param UserNaturalFilter $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'first_name' => $entity->getFirstName(),
            'last_name' => $entity->getLastName(),
            
        ];
        
    }
}
