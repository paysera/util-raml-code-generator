<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\UserRiskLevelApiBundle\Entity\AuditRecord;

class AuditRecordNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return AuditRecord
     */
    public function mapToEntity($data)
    {
        $entity = new AuditRecord();

        if (isset($data['comment'])) {
            $entity->setComment($data['comment']);
        }
        
        return $entity;
    }

    /**
     * @param AuditRecord $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'comment' => $entity->getComment(),
            
        ];
    }
}
