<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Evp\Component\Money\MoneyNormalizer;
use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\OutCommissionRule;

class OutCommissionRuleNormalizer implements NormalizerInterface, DenormalizerInterface
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
     * @return OutCommissionRule
     */
    public function mapToEntity($data)
    {
        $entity = new OutCommissionRule();

        if (isset($data['percent'])) {
            $entity->setPercent($data['percent']);
        }
        if (isset($data['min'])) {
            $entity->setMin($this->moneyNormalizer->mapToEntity($data['min']));
        }
        if (isset($data['max'])) {
            $entity->setMax($this->moneyNormalizer->mapToEntity($data['max']));
        }
        if (isset($data['fix'])) {
            $entity->setFix($this->moneyNormalizer->mapToEntity($data['fix']));
        }
        
        return $entity;
    }

    /**
     * @param OutCommissionRule $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'percent' => $entity->getPercent(),
            'min' => $entity->getMin() !== null ? $this->moneyNormalizer->mapFromEntity($entity->getMin()) : null,
            'max' => $entity->getMax() !== null ? $this->moneyNormalizer->mapFromEntity($entity->getMax()) : null,
            'fix' => $entity->getFix() !== null ? $this->moneyNormalizer->mapFromEntity($entity->getFix()) : null,
            
        ];
    }
}
