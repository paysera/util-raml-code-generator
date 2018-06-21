<?php

namespace Vendor\Test\AccountApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\AccountApiBundle\Entity\Account;

class AccountNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $undescribedTypeNormalizer;
    
    public function __construct(
        UndescribedTypeNormalizer $undescribedTypeNormalizer
    ) {
        $this->undescribedTypeNormalizer = $undescribedTypeNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return Account
     */
    public function mapToEntity($data)
    {
        $entity = new Account();

        if (isset($data['created_at'])) {
            $entity->setCreatedAt((new \DateTime())->setTimestamp($data['created_at']));
        }
        if (isset($data['number'])) {
            $entity->setNumber($data['number']);
        }
        if (isset($data['active'])) {
            $entity->setActive($data['active']);
        }
        if (isset($data['client_id'])) {
            $entity->setClientId($data['client_id']);
        }
        if (isset($data['closed'])) {
            $entity->setClosed($data['closed']);
        }
        if (isset($data['type'])) {
            $entity->setType($data['type']);
        }
        if (isset($data['undescribed'])) {
            $entity->setUndescribed($this->undescribedTypeNormalizer->mapToEntity($data['undescribed']));
        }
        
        return $entity;
    }

    /**
     * @param Account $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'created_at' => $entity->getCreatedAt()->getTimestamp(),
            'number' => $entity->getNumber(),
            'active' => $entity->isActive(),
            'client_id' => $entity->getClientId(),
            'closed' => $entity->isClosed(),
            'type' => $entity->getType(),
            'undescribed' => $entity->getUndescribed() !== null ? $this->undescribedTypeNormalizer->mapFromEntity($entity->getUndescribed()) : null,
            
        ];
    }
}
