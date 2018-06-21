<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferFailureStatus;

class TransferFailureStatusNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return TransferFailureStatus
     */
    public function mapToEntity($data)
    {
        $entity = new TransferFailureStatus();

        if (isset($data['code'])) {
            $entity->setCode($data['code']);
        }
        if (isset($data['message'])) {
            $entity->setMessage($data['message']);
        }
        
        return $entity;
    }

    /**
     * @param TransferFailureStatus $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'code' => $entity->getCode(),
            'message' => $entity->getMessage(),
            
        ];
    }
}
