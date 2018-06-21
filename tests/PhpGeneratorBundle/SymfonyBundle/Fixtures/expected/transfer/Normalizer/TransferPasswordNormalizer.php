<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferPassword;

class TransferPasswordNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return TransferPassword
     */
    public function mapToEntity($data)
    {
        $entity = new TransferPassword();

        if (isset($data['password'])) {
            $entity->setPassword($data['password']);
        }
        
        return $entity;
    }

    /**
     * @param TransferPassword $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'password' => $entity->getPassword(),
            
        ];
    }
}
