<?php

namespace Vendor\Test\CategoryApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\CategoryApiBundle\Entity\Category;

class CategoryNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Category
     */
    public function mapToEntity($data)
    {
        $entity = new Category();

        if (isset($data['parent_id'])) {
            $entity->setParentId($data['parent_id']);
        }
        if (isset($data['titles'])) {
            $entity->setTitles($data['titles']);
        }
        if (isset($data['status'])) {
            $entity->setStatus($data['status']);
        }
        
        return $entity;
    }

    /**
     * @param Category $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'parent_id' => $entity->getParentId(),
            'titles' => $entity->getTitles(),
            'status' => $entity->getStatus(),
            
        ];
    }
}
