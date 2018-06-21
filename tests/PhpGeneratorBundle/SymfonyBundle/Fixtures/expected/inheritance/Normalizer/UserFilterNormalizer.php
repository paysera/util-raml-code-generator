<?php

namespace Vendor\Test\InheritanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\FilterNormalizer;
use Vendor\Test\InheritanceApiBundle\Entity\UserFilter;

class UserFilterNormalizer extends FilterNormalizer
{
    /**
     * @param array $data
     *
     * @return UserFilter
     */
    public function mapToEntity($data)
    {
        $entity = new UserFilter();
        $this->mapBaseKeys($data, $entity);

        if (isset($data['user_id'])) {
            $entity->setUserId($data['user_id']);
        }
        if (isset($data['user_type'])) {
            $entity->setUserType($data['user_type']);
        }
        
        return $entity;
    }

    /**
     * @param UserFilter $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        $data = parent::mapFromEntity($entity);
        return array_merge(
            $data,
            [
                'user_id' => $entity->getUserId(),
                'user_type' => $entity->getUserType(),
                
            ]
        );
        
    }
}
