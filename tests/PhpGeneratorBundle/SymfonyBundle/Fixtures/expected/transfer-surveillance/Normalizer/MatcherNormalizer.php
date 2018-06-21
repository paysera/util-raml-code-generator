<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferSurveillanceApiBundle\Entity\Matcher;

class MatcherNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Matcher
     */
    public function mapToEntity($data)
    {
        $entity = new Matcher();

        if (isset($data['identifier'])) {
            $entity->setIdentifier($data['identifier']);
        }
        if (isset($data['description'])) {
            $entity->setDescription($data['description']);
        }
        
        return $entity;
    }

    /**
     * @param Matcher $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'identifier' => $entity->getIdentifier(),
            'description' => $entity->getDescription(),
            
        ];
    }
}
