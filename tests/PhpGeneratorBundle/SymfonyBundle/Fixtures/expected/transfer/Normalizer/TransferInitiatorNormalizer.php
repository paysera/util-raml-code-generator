<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferInitiator;

class TransferInitiatorNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return TransferInitiator
     */
    public function mapToEntity($data)
    {
        $entity = new TransferInitiator();

        if (isset($data['user_id'])) {
            $entity->setUserId($data['user_id']);
        }
        if (isset($data['client_id'])) {
            $entity->setClientId($data['client_id']);
        }
        
        return $entity;
    }

    /**
     * @param TransferInitiator $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'user_id' => $entity->getUserId(),
            'client_id' => $entity->getClientId(),
            
        ];
    }
}
