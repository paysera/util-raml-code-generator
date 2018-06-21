<?php

namespace Vendor\Test\AuthApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\AuthApiBundle\Entity\AuthToken;

class AuthTokenNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return AuthToken
     */
    public function mapToEntity($data)
    {
        $entity = new AuthToken();

        if (isset($data['value'])) {
            $entity->setValue($data['value']);
        }
        
        return $entity;
    }

    /**
     * @param AuthToken $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'value' => $entity->getValue(),
            
        ];
    }
}
