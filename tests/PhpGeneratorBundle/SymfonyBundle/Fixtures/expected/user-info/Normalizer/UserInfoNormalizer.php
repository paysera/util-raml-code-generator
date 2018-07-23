<?php

namespace Vendor\Test\UserInfoApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\UserInfoApiBundle\Entity\UserInfo;

class UserInfoNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return UserInfo
     */
    public function mapToEntity($data)
    {
        $entity = new UserInfo();

        if (isset($data['type'])) {
            $entity->setType($data['type']);
        }
        if (isset($data['created_timestamp'])) {
            $entity->setCreatedTimestamp((new \DateTime())->setTimestamp($data['created_timestamp']));
        }
        if (isset($data['created_datetime'])) {
            $entity->setCreatedDatetime(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['created_datetime']));
        }
        if (isset($data['created_date_only'])) {
            $entity->setCreatedDateOnly(\DateTime::createFromFormat('Y-m-d', $data['created_date_only']));
        }
        if (isset($data['created_time_only'])) {
            $entity->setCreatedTimeOnly(\DateTime::createFromFormat('H:i:s', $data['created_time_only']));
        }
        if (isset($data['created_datetime_only'])) {
            $entity->setCreatedDatetimeOnly(\DateTime::createFromFormat('Y-m-d\TH:i:s', $data['created_datetime_only']));
        }
        
        return $entity;
    }

    /**
     * @param UserInfo $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'type' => $entity->getType(),
            'created_timestamp' => $entity->getCreatedTimestamp()->getTimestamp(),
            'created_datetime' => $entity->getCreatedDatetime() !== null ? $entity->getCreatedDatetime()->format('Y-m-d\TH:i:sP') : null,
            'created_date_only' => $entity->getCreatedDateOnly() !== null ? $entity->getCreatedDateOnly()->format('Y-m-d') : null,
            'created_time_only' => $entity->getCreatedTimeOnly() !== null ? $entity->getCreatedTimeOnly()->format('H:i:s') : null,
            'created_datetime_only' => $entity->getCreatedDatetimeOnly() !== null ? $entity->getCreatedDatetimeOnly()->format('Y-m-d\TH:i:s') : null,
            
        ];
    }
}
