<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferNotifcation;

class TransferNotifcationNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return TransferNotifcation
     */
    public function mapToEntity($data)
    {
        $entity = new TransferNotifcation();

        if (isset($data['locale'])) {
            $entity->setLocale($data['locale']);
        }
        if (isset($data['email'])) {
            $entity->setEmail($data['email']);
        }
        
        return $entity;
    }

    /**
     * @param TransferNotifcation $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'locale' => $entity->getLocale(),
            'email' => $entity->getEmail(),
            
        ];
    }
}
