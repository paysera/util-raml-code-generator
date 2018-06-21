<?php

namespace Vendor\Test\CategoryApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\FilterNormalizer;
use Vendor\Test\CategoryApiBundle\Entity\CategoryFilter;

class CategoryFilterNormalizer extends FilterNormalizer
{
    /**
     * @param array $data
     *
     * @return CategoryFilter
     */
    public function mapToEntity($data)
    {
        $entity = new CategoryFilter();
        $this->mapBaseKeys($data, $entity);

        if (isset($data['parent_id'])) {
            $entity->setParentId($data['parent_id']);
        }
        
        return $entity;
    }

    /**
     * @param CategoryFilter $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        $data = parent::mapFromEntity($entity);
        return array_merge(
            $data,
            [
                'parent_id' => $entity->getParentId(),
                
            ]
        );
        
    }
}
