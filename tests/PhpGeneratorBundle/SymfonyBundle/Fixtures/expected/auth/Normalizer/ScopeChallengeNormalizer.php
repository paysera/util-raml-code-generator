<?php

namespace Vendor\Test\AuthApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\AuthApiBundle\Entity\ScopeChallenge;

class ScopeChallengeNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return ScopeChallenge
     */
    public function mapToEntity($data)
    {
        $entity = new ScopeChallenge();

        if (isset($data['challenge_id'])) {
            $entity->setChallengeId($data['challenge_id']);
        }
        
        return $entity;
    }

    /**
     * @param ScopeChallenge $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'challenge_id' => $entity->getChallengeId(),
            
        ];
    }
}
