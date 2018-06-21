<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\ConvertCurrency;

class ConvertCurrencyNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return ConvertCurrency
     */
    public function mapToEntity($data)
    {
        $entity = new ConvertCurrency();

        if (isset($data['from_currency'])) {
            $entity->setFromCurrency($data['from_currency']);
        }
        if (isset($data['to_currency'])) {
            $entity->setToCurrency($data['to_currency']);
        }
        if (isset($data['to_amount'])) {
            $entity->setToAmount($data['to_amount']);
        }
        if (isset($data['from_amount'])) {
            $entity->setFromAmount($data['from_amount']);
        }
        if (isset($data['min_to_amount'])) {
            $entity->setMinToAmount($data['min_to_amount']);
        }
        if (isset($data['max_from_amount'])) {
            $entity->setMaxFromAmount($data['max_from_amount']);
        }
        if (isset($data['account_number'])) {
            $entity->setAccountNumber($data['account_number']);
        }
        
        return $entity;
    }

    /**
     * @param ConvertCurrency $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'from_currency' => $entity->getFromCurrency(),
            'to_currency' => $entity->getToCurrency(),
            'to_amount' => $entity->getToAmount(),
            'from_amount' => $entity->getFromAmount(),
            'min_to_amount' => $entity->getMinToAmount(),
            'max_from_amount' => $entity->getMaxFromAmount(),
            'account_number' => $entity->getAccountNumber(),
            
        ];
    }
}
