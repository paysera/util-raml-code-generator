<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\Payer;

class PayerNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Payer
     */
    public function mapToEntity($data)
    {
        $entity = new Payer();

        if (isset($data['account_number'])) {
            $entity->setAccountNumber($data['account_number']);
        }
        if (isset($data['reference'])) {
            $entity->setReference($data['reference']);
        }
        
        return $entity;
    }

    /**
     * @param Payer $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'account_number' => $entity->getAccountNumber(),
            'reference' => $entity->getReference(),
            
        ];
    }
}
