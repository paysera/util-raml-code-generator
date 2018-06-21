<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\ArrayNormalizer;
use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransfersBatch;

class TransfersBatchNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $convertCurrencyNormalizer;
    
    public function __construct(
        ArrayNormalizer $convertCurrencyNormalizer
    ) {
        $this->convertCurrencyNormalizer = $convertCurrencyNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return TransfersBatch
     */
    public function mapToEntity($data)
    {
        $entity = new TransfersBatch();

        if (isset($data['revoked_transfers'])) {
            $entity->setRevokedTransfers($data['revoked_transfers']);
        }
        if (isset($data['reserved_transfers'])) {
            $entity->setReservedTransfers($data['reserved_transfers']);
        }
        if (isset($data['convert_currency'])) {
            $entity->setConvertCurrency($this->convertCurrencyNormalizer->mapToEntity($data['convert_currency']));
        }
        
        return $entity;
    }

    /**
     * @param TransfersBatch $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'revoked_transfers' => $entity->getRevokedTransfers(),
            'reserved_transfers' => $entity->getReservedTransfers(),
            'convert_currency' => $this->convertCurrencyNormalizer->mapFromEntity($entity->getConvertCurrency()),
            
        ];
    }
}
