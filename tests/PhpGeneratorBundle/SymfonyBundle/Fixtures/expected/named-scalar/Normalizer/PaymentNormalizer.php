<?php

namespace Vendor\Test\NamedScalarApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\NamedScalarApiBundle\Entity\Payment;

class PaymentNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $paymentMetadataNormalizer;
    private $searchResultMetadataNormalizer;
    
    public function __construct(
        PaymentMetadataNormalizer $paymentMetadataNormalizer,
        SearchResultMetadataNormalizer $searchResultMetadataNormalizer
    ) {
        $this->paymentMetadataNormalizer = $paymentMetadataNormalizer;
        $this->searchResultMetadataNormalizer = $searchResultMetadataNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return Payment
     */
    public function mapToEntity($data)
    {
        $entity = new Payment();

        if (isset($data['currency'])) {
            $entity->setCurrency($data['currency']);
        }
        if (isset($data['allowed_currencies'])) {
            $entity->setAllowedCurrencies($data['allowed_currencies']);
        }
        if (isset($data['account_number'])) {
            $entity->setAccountNumber($data['account_number']);
        }
        if (isset($data['scan_result'])) {
            $entity->setScanResult($data['scan_result']);
        }
        if (isset($data['filter_mode'])) {
            $entity->setFilterMode($data['filter_mode']);
        }
        if (isset($data['metadata'])) {
            $entity->setMetadata($this->paymentMetadataNormalizer->mapToEntity($data['metadata']));
        }
        if (isset($data['search_metadata'])) {
            $entity->setSearchMetadata($this->searchResultMetadataNormalizer->mapToEntity($data['search_metadata']));
        }
        
        return $entity;
    }

    /**
     * @param Payment $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'currency' => $entity->getCurrency(),
            'allowed_currencies' => $entity->getAllowedCurrencies(),
            'account_number' => $entity->getAccountNumber(),
            'scan_result' => $entity->getScanResult(),
            'filter_mode' => $entity->getFilterMode(),
            'metadata' => $entity->getMetadata() !== null ? $this->paymentMetadataNormalizer->mapFromEntity($entity->getMetadata()) : null,
            'search_metadata' => $entity->getSearchMetadata() !== null ? $this->searchResultMetadataNormalizer->mapFromEntity($entity->getSearchMetadata()) : null,
            
        ];
    }
}
