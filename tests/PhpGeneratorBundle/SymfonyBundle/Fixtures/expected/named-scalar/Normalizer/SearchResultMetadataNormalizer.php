<?php

namespace Vendor\Test\NamedScalarApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\NamedScalarApiBundle\Entity\SearchResultMetadata;

class SearchResultMetadataNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return SearchResultMetadata
     */
    public function mapToEntity($data)
    {
        $entity = new SearchResultMetadata();

        if (isset($data['source'])) {
            $entity->setSource($data['source']);
        }
        if (isset($data['matched'])) {
            $entity->setMatched($data['matched']);
        }
        
        return $entity;
    }

    /**
     * @param SearchResultMetadata $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'source' => $entity->getSource(),
            'matched' => $entity->getMatched(),
            
        ];
    }
}
