<?php

namespace Vendor\Test\AuthApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\AuthApiBundle\Entity\Credentials;

class CredentialsNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Credentials
     */
    public function mapToEntity($data)
    {
        $entity = new Credentials();

        if (isset($data['username'])) {
            $entity->setUsername($data['username']);
        }
        if (isset($data['password'])) {
            $entity->setPassword($data['password']);
        }
        
        return $entity;
    }

    /**
     * @param Credentials $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'username' => $entity->getUsername(),
            'password' => $entity->getPassword(),
            
        ];
    }
}
