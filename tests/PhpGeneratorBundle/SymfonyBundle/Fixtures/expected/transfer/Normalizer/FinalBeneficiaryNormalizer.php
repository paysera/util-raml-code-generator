<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\FinalBeneficiary;

class FinalBeneficiaryNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $identifiersNormalizer;
    
    public function __construct(
        IdentifiersNormalizer $identifiersNormalizer
    ) {
        $this->identifiersNormalizer = $identifiersNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return FinalBeneficiary
     */
    public function mapToEntity($data)
    {
        $entity = new FinalBeneficiary();

        if (isset($data['name'])) {
            $entity->setName($data['name']);
        }
        if (isset($data['identifiers'])) {
            $entity->setIdentifiers($this->identifiersNormalizer->mapToEntity($data['identifiers']));
        }
        if (isset($data['person_type'])) {
            $entity->setPersonType($data['person_type']);
        }
        
        return $entity;
    }

    /**
     * @param FinalBeneficiary $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'identifiers' => $entity->getIdentifiers() !== null ? $this->identifiersNormalizer->mapFromEntity($entity->getIdentifiers()) : null,
            'person_type' => $entity->getPersonType(),
            
        ];
    }
}
