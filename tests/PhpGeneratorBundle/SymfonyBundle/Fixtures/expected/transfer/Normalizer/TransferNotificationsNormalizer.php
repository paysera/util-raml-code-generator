<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferNotifications;

class TransferNotificationsNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $transferNotifcationNormalizer;
    
    public function __construct(
        TransferNotifcationNormalizer $transferNotifcationNormalizer
    ) {
        $this->transferNotifcationNormalizer = $transferNotifcationNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return TransferNotifications
     */
    public function mapToEntity($data)
    {
        $entity = new TransferNotifications();

        if (isset($data['done'])) {
            $entity->setDone($this->transferNotifcationNormalizer->mapToEntity($data['done']));
        }
        
        return $entity;
    }

    /**
     * @param TransferNotifications $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'done' => $entity->getDone() !== null ? $this->transferNotifcationNormalizer->mapFromEntity($entity->getDone()) : null,
            
        ];
    }
}
