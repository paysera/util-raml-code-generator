<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\PayzaAccount;

class PayzaAccountNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return PayzaAccount
     */
    public function mapToEntity($data)
    {
        $entity = new PayzaAccount();

        if (isset($data['email'])) {
            $entity->setEmail($data['email']);
        }
        
        return $entity;
    }

    /**
     * @param PayzaAccount $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'email' => $entity->getEmail(),
            
        ];
    }
}
