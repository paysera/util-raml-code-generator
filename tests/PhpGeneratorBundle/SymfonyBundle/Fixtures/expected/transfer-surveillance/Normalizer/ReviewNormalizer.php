<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferSurveillanceApiBundle\Entity\Review;

class ReviewNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Review
     */
    public function mapToEntity($data)
    {
        $entity = new Review();

        if (isset($data['reviewer_user_id'])) {
            $entity->setReviewerUserId($data['reviewer_user_id']);
        }
        if (isset($data['comment'])) {
            $entity->setComment($data['comment']);
        }
        if (isset($data['internal_comment'])) {
            $entity->setInternalComment($data['internal_comment']);
        }
        
        return $entity;
    }

    /**
     * @param Review $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'reviewer_user_id' => $entity->getReviewerUserId(),
            'comment' => $entity->getComment(),
            'internal_comment' => $entity->getInternalComment(),
            
        ];
    }
}
