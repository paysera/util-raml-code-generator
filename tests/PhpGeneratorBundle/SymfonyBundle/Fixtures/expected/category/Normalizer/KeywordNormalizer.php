<?php

namespace Vendor\Test\CategoryApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\CategoryApiBundle\Entity\Keyword;

class KeywordNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Keyword
     */
    public function mapToEntity($data)
    {
        $entity = new Keyword();

        if (isset($data['name'])) {
            $entity->setName($data['name']);
        }
        
        return $entity;
    }

    /**
     * @param Keyword $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            
        ];
    }
}
