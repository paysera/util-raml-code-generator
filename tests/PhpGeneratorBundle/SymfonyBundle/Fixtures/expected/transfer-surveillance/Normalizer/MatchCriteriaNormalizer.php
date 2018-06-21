<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferSurveillanceApiBundle\Entity\MatchCriteria;

class MatchCriteriaNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return MatchCriteria
     */
    public function mapToEntity($data)
    {
        $entity = new MatchCriteria();

        if (isset($data['matcher_identifier'])) {
            $entity->setMatcherIdentifier($data['matcher_identifier']);
        }
        if (isset($data['query'])) {
            $entity->setQuery($data['query']);
        }
        if (isset($data['description'])) {
            $entity->setDescription($data['description']);
        }
        if (isset($data['parameters'])) {
            $entity->setParameters($data['parameters']);
        }
        
        return $entity;
    }

    /**
     * @param MatchCriteria $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'matcher_identifier' => $entity->getMatcherIdentifier(),
            'query' => $entity->getQuery(),
            'description' => $entity->getDescription(),
            'parameters' => $entity->getParameters(),
            
        ];
    }
}
