<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\DetailsOptions;

class DetailsOptionsNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return DetailsOptions
     */
    public function mapToEntity($data)
    {
        $entity = new DetailsOptions();

        if (isset($data['preserve'])) {
            $entity->setPreserve($data['preserve']);
        }
        
        return $entity;
    }

    /**
     * @param DetailsOptions $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'preserve' => $entity->isPreserve(),
            
        ];
    }
}
