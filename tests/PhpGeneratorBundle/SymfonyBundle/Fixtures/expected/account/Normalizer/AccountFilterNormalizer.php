<?php

namespace Vendor\Test\AccountApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\FilterNormalizer;
use Vendor\Test\AccountApiBundle\Entity\AccountFilter;

class AccountFilterNormalizer extends FilterNormalizer
{
    /**
     * @param array $data
     *
     * @return AccountFilter
     */
    public function mapToEntity($data)
    {
        $entity = new AccountFilter();
        $this->mapBaseKeys($data, $entity);

        if (isset($data['type'])) {
            $entity->setType($data['type']);
        }
        if (isset($data['administered_by_user_id'])) {
            $entity->setAdministeredByUserId($data['administered_by_user_id']);
        }
        if (isset($data['owned_by_user_id'])) {
            $entity->setOwnedByUserId($data['owned_by_user_id']);
        }
        if (isset($data['closed'])) {
            $entity->setClosed($data['closed']);
        }
        if (isset($data['readable_by_client_id'])) {
            $entity->setReadableByClientId($data['readable_by_client_id']);
        }
        if (isset($data['active'])) {
            $entity->setActive($data['active']);
        }
        
        return $entity;
    }

    /**
     * @param AccountFilter $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        $data = parent::mapFromEntity($entity);
        return array_merge(
            $data,
            [
                'type' => $entity->getType(),
                'administered_by_user_id' => $entity->getAdministeredByUserId(),
                'owned_by_user_id' => $entity->getOwnedByUserId(),
                'closed' => $entity->isClosed(),
                'readable_by_client_id' => $entity->getReadableByClientId(),
                'active' => $entity->isActive(),
                
            ]
        );
        
    }
}
