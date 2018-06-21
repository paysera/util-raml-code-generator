<?php

namespace Vendor\Test\UserInfoApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\UserInfoApiBundle\Entity\Legal;

class LegalNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Legal
     */
    public function mapToEntity($data)
    {
        // TODO: generated_code this entity uses Inheritance, you should map parent fields manually
        $entity = new Legal();

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
     * @param Legal $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        // TODO: generated_code this entity uses Inheritance, you should map parent fields manually
        return [
            'id' => $entity->getId(),
            'company_name' => $entity->getCompanyName(),
            'company_code' => $entity->getCompanyCode(),
            'vat_code' => $entity->getVatCode(),
            
        ];
    }
}
