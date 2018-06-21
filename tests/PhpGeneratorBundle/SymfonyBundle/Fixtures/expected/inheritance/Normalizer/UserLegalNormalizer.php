<?php

namespace Vendor\Test\InheritanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\InheritanceApiBundle\Entity\UserLegal;

class UserLegalNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return UserLegal
     */
    public function mapToEntity($data)
    {
        $entity = new UserLegal();

        if (isset($data['company_name'])) {
            $entity->setCompanyName($data['company_name']);
        }
        if (isset($data['company_code'])) {
            $entity->setCompanyCode($data['company_code']);
        }
        if (isset($data['vat_code'])) {
            $entity->setVatCode($data['vat_code']);
        }
        
        return $entity;
    }

    /**
     * @param UserLegal $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'company_name' => $entity->getCompanyName(),
            'company_code' => $entity->getCompanyCode(),
            'vat_code' => $entity->getVatCode(),
            
        ];
    }
}
