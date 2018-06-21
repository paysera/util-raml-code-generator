<?php

namespace Vendor\Test\AuthApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\AuthApiBundle\Entity\SystemTokenRequest;

class SystemTokenRequestNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return SystemTokenRequest
     */
    public function mapToEntity($data)
    {
        $entity = new SystemTokenRequest();

        if (isset($data['scope'])) {
            $entity->setScope($data['scope']);
        }
        if (isset($data['audience'])) {
            $entity->setAudience($data['audience']);
        }
        
        return $entity;
    }

    /**
     * @param SystemTokenRequest $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'scope' => $entity->getScope(),
            'audience' => $entity->getAudience(),
            
        ];
    }
}
