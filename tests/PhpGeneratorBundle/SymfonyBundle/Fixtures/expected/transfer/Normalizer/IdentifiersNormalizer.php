<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\Identifiers;

class IdentifiersNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Identifiers
     */
    public function mapToEntity($data)
    {
        $entity = new Identifiers();

        if (isset($data['general'])) {
            $entity->setGeneral($data['general']);
        }
        if (isset($data['personal_code'])) {
            $entity->setPersonalCode($data['personal_code']);
        }
        if (isset($data['legal_code'])) {
            $entity->setLegalCode($data['legal_code']);
        }
        if (isset($data['tax_code'])) {
            $entity->setTaxCode($data['tax_code']);
        }
        if (isset($data['kpp_code'])) {
            $entity->setKppCode($data['kpp_code']);
        }
        
        return $entity;
    }

    /**
     * @param Identifiers $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'general' => $entity->getGeneral(),
            'personal_code' => $entity->getPersonalCode(),
            'legal_code' => $entity->getLegalCode(),
            'tax_code' => $entity->getTaxCode(),
            'kpp_code' => $entity->getKppCode(),
            
        ];
    }
}
