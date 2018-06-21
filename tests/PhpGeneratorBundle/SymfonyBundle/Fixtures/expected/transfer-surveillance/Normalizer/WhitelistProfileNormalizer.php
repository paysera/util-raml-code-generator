<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferSurveillanceApiBundle\Entity\WhitelistProfile;

class WhitelistProfileNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return WhitelistProfile
     */
    public function mapToEntity($data)
    {
        $entity = new WhitelistProfile();

        if (isset($data['blacklist_id'])) {
            $entity->setBlacklistId($data['blacklist_id']);
        }
        if (isset($data['external_id'])) {
            $entity->setExternalId($data['external_id']);
        }
        
        return $entity;
    }

    /**
     * @param WhitelistProfile $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'blacklist_id' => $entity->getBlacklistId(),
            'external_id' => $entity->getExternalId(),
            
        ];
    }
}
