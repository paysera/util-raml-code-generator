<?php

namespace Vendor\Test\InheritanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\FilterNormalizer;
use Vendor\Test\InheritanceApiBundle\Entity\UserLegalFilter;

class UserLegalFilterNormalizer extends FilterNormalizer
{
    /**
     * @param array $data
     *
     * @return UserLegalFilter
     */
    public function mapToEntity($data)
    {
        $entity = new UserLegalFilter();
        $this->mapBaseKeys($data, $entity);

        if (isset($data['company_name'])) {
            $entity->setCompanyName($data['company_name']);
        }
        
        return $entity;
    }

    /**
     * @param UserLegalFilter $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        $data = parent::mapFromEntity($entity);
        return array_merge(
            $data,
            [
                'company_name' => $entity->getCompanyName(),
                
            ]
        );
        
    }
}
