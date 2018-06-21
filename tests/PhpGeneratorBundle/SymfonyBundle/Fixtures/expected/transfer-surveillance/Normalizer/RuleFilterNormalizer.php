<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\FilterNormalizer;
use Vendor\Test\TransferSurveillanceApiBundle\Entity\RuleFilter;

class RuleFilterNormalizer extends FilterNormalizer
{
    /**
     * @param array $data
     *
     * @return RuleFilter
     */
    public function mapToEntity($data)
    {
        $entity = new RuleFilter();
        $this->mapBaseKeys($data, $entity);

        if (isset($data['order_by'])) {
            $entity->setOrderBy($data['order_by']);
        }
        
        return $entity;
    }

    /**
     * @param RuleFilter $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        $data = parent::mapFromEntity($entity);
        return array_merge(
            $data,
            [
                'order_by' => $entity->getOrderBy(),
                
            ]
        );
        
    }
}
