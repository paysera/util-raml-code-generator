<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\PayseraAccount;

class PayseraAccountNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return PayseraAccount
     */
    public function mapToEntity($data)
    {
        $entity = new PayseraAccount();

        if (isset($data['account_number'])) {
            $entity->setAccountNumber($data['account_number']);
        }
        if (isset($data['email'])) {
            $entity->setEmail($data['email']);
        }
        if (isset($data['phone'])) {
            $entity->setPhone($data['phone']);
        }
        
        return $entity;
    }

    /**
     * @param PayseraAccount $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'account_number' => $entity->getAccountNumber(),
            'email' => $entity->getEmail(),
            'phone' => $entity->getPhone(),
            
        ];
    }
}
