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
            
        ];
    }
}
