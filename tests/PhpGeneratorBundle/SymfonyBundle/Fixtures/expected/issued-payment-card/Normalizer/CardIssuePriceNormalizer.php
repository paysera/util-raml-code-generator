<?php

namespace Vendor\Test\IssuedPaymentCardApiBundle\Normalizer;

use Evp\Component\Money\MoneyNormalizer;
use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\IssuedPaymentCardApiBundle\Entity\CardIssuePrice;

class CardIssuePriceNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $moneyNormalizer;
    
    public function __construct(
        MoneyNormalizer $moneyNormalizer
    ) {
        $this->moneyNormalizer = $moneyNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return CardIssuePrice
     */
    public function mapToEntity($data)
    {
        $entity = new CardIssuePrice();

        if (isset($data['price'])) {
            $entity->setPrice($this->moneyNormalizer->mapToEntity($data['price']));
        }
        if (isset($data['country'])) {
            $entity->setCountry($data['country']);
        }
        if (isset($data['client_type'])) {
            $entity->setClientType($data['client_type']);
        }
        
        return $entity;
    }

    /**
     * @param CardIssuePrice $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'price' => $entity->getPrice() !== null ? $this->moneyNormalizer->mapFromEntity($entity->getPrice()) : null,
            'country' => $entity->getCountry(),
            'client_type' => $entity->getClientType(),
            
        ];
    }
}
