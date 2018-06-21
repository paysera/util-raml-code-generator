<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\ArrayNormalizer;
use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferRegistrationParameters;

class TransferRegistrationParametersNormalizer implements NormalizerInterface, DenormalizerInterface
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
     * @return TransferRegistrationParameters
     */
    public function mapToEntity($data)
    {
        $entity = new TransferRegistrationParameters();

        if (isset($data['convert_currency'])) {
            $entity->setConvertCurrency($this->convertCurrencyNormalizer->mapToEntity($data['convert_currency']));
        }
        
        return $entity;
    }

    /**
     * @param TransferRegistrationParameters $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'convert_currency' => $this->convertCurrencyNormalizer->mapFromEntity($entity->getConvertCurrency()),
            
        ];
    }
}
