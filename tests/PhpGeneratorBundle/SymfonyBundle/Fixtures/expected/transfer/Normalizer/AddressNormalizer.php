<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\Address;

class AddressNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Address
     */
    public function mapToEntity($data)
    {
        $entity = new Address();

        if (isset($data['country_code'])) {
            $entity->setCountryCode($data['country_code']);
        }
        if (isset($data['address_line'])) {
            $entity->setAddressLine($data['address_line']);
        }
        
        return $entity;
    }

    /**
     * @param Address $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'country_code' => $entity->getCountryCode(),
            'address_line' => $entity->getAddressLine(),
            
        ];
    }
}
