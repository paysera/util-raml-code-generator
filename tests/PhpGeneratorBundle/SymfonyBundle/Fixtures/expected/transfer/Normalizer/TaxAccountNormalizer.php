<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TaxAccount;

class TaxAccountNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return TaxAccount
     */
    public function mapToEntity($data)
    {
        $entity = new TaxAccount();

        if (isset($data['identifier'])) {
            $entity->setIdentifier($data['identifier']);
        }
        
        return $entity;
    }

    /**
     * @param TaxAccount $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'identifier' => $entity->getIdentifier(),
            
        ];
    }
}
