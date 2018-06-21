<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferPassword34;

class TransferPassword34Normalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return TransferPassword34
     */
    public function mapToEntity($data)
    {
        $entity = new TransferPassword34();

        if (isset($data['status'])) {
            $entity->setStatus($data['status']);
        }
        if (isset($data['value'])) {
            $entity->setValue($data['value']);
        }
        
        return $entity;
    }

    /**
     * @param TransferPassword34 $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'status' => $entity->getStatus(),
            'value' => $entity->getValue(),
            
        ];
    }
}
