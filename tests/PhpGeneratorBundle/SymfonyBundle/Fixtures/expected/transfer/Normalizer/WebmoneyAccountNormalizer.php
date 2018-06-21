<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\WebmoneyAccount;

class WebmoneyAccountNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return WebmoneyAccount
     */
    public function mapToEntity($data)
    {
        $entity = new WebmoneyAccount();

        if (isset($data['purse'])) {
            $entity->setPurse($data['purse']);
        }
        
        return $entity;
    }

    /**
     * @param WebmoneyAccount $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'purse' => $entity->getPurse(),
            
        ];
    }
}
