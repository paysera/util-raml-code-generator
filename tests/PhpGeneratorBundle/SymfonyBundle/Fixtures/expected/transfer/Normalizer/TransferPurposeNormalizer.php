<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferPurpose;

class TransferPurposeNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $detailsOptionsNormalizer;
    
    public function __construct(
        DetailsOptionsNormalizer $detailsOptionsNormalizer
    ) {
        $this->detailsOptionsNormalizer = $detailsOptionsNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return TransferPurpose
     */
    public function mapToEntity($data)
    {
        $entity = new TransferPurpose();

        if (isset($data['details'])) {
            $entity->setDetails($data['details']);
        }
        if (isset($data['reference'])) {
            $entity->setReference($data['reference']);
        }
        if (isset($data['vo_code'])) {
            $entity->setVoCode($data['vo_code']);
        }
        if (isset($data['ocr_code'])) {
            $entity->setOcrCode($data['ocr_code']);
        }
        if (isset($data['details_options'])) {
            $entity->setDetailsOptions($this->detailsOptionsNormalizer->mapToEntity($data['details_options']));
        }
        if (isset($data['code'])) {
            $entity->setCode($data['code']);
        }
        
        return $entity;
    }

    /**
     * @param TransferPurpose $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'details' => $entity->getDetails(),
            'reference' => $entity->getReference(),
            'vo_code' => $entity->getVoCode(),
            'ocr_code' => $entity->getOcrCode(),
            'details_options' => $entity->getDetailsOptions() !== null ? $this->detailsOptionsNormalizer->mapFromEntity($entity->getDetailsOptions()) : null,
            'code' => $entity->getCode(),
            
        ];
    }
}
