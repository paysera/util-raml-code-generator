<?php

namespace Vendor\Test\NamedScalarApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\NamedScalarApiBundle\Entity\PaymentMetadata;

class PaymentMetadataNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return PaymentMetadata
     */
    public function mapToEntity($data)
    {
        $entity = new PaymentMetadata();

        if (isset($data['source'])) {
            $entity->setSource($data['source']);
        }
        if (isset($data['channel'])) {
            $entity->setChannel($data['channel']);
        }
        
        return $entity;
    }

    /**
     * @param PaymentMetadata $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'source' => $entity->getSource(),
            'channel' => $entity->getChannel(),
            
        ];
    }
}
