<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\ArrayNormalizer;
use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransfersBatchResult;

class TransfersBatchResultNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $revokedTransfersNormalizer;
    private $reservedTransfersNormalizer;
    
    public function __construct(
        ArrayNormalizer $revokedTransfersNormalizer,
        ArrayNormalizer $reservedTransfersNormalizer
    ) {
        $this->revokedTransfersNormalizer = $revokedTransfersNormalizer;
        $this->reservedTransfersNormalizer = $reservedTransfersNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return TransfersBatchResult
     */
    public function mapToEntity($data)
    {
        $entity = new TransfersBatchResult();

        if (isset($data['revoked_transfers'])) {
            $entity->setRevokedTransfers($this->revokedTransfersNormalizer->mapToEntity($data['revoked_transfers']));
        }
        if (isset($data['reserved_transfers'])) {
            $entity->setReservedTransfers($this->reservedTransfersNormalizer->mapToEntity($data['reserved_transfers']));
        }
        
        return $entity;
    }

    /**
     * @param TransfersBatchResult $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'revoked_transfers' => $this->revokedTransfersNormalizer->mapFromEntity($entity->getRevokedTransfers()),
            'reserved_transfers' => $this->reservedTransfersNormalizer->mapFromEntity($entity->getReservedTransfers()),
            
        ];
    }
}
