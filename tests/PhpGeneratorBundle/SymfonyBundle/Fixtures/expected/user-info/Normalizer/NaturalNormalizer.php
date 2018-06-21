<?php

namespace Vendor\Test\UserInfoApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\UserInfoApiBundle\Entity\Natural;

class NaturalNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Natural
     */
    public function mapToEntity($data)
    {
        // TODO: generated_code this entity uses Inheritance, you should map parent fields manually
        $entity = new Natural();

        if (isset($data['name'])) {
            $entity->setName($data['name']);
        }
        if (isset($data['surname'])) {
            $entity->setSurname($data['surname']);
        }
        
        return $entity;
    }

    /**
     * @param Natural $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        // TODO: generated_code this entity uses Inheritance, you should map parent fields manually
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'surname' => $entity->getSurname(),
            
        ];
    }
}
