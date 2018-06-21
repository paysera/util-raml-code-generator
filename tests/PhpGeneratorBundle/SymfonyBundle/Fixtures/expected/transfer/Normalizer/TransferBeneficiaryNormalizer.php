<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\TransferBeneficiary;

class TransferBeneficiaryNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $identifiersNormalizer;
    private $bankAccountNormalizer;
    private $taxAccountNormalizer;
    private $payseraAccountNormalizer;
    private $payzaAccountNormalizer;
    private $webmoneyAccountNormalizer;
    
    public function __construct(
        IdentifiersNormalizer $identifiersNormalizer,
        BankAccountNormalizer $bankAccountNormalizer,
        TaxAccountNormalizer $taxAccountNormalizer,
        PayseraAccountNormalizer $payseraAccountNormalizer,
        PayzaAccountNormalizer $payzaAccountNormalizer,
        WebmoneyAccountNormalizer $webmoneyAccountNormalizer
    ) {
        $this->identifiersNormalizer = $identifiersNormalizer;
        $this->bankAccountNormalizer = $bankAccountNormalizer;
        $this->taxAccountNormalizer = $taxAccountNormalizer;
        $this->payseraAccountNormalizer = $payseraAccountNormalizer;
        $this->payzaAccountNormalizer = $payzaAccountNormalizer;
        $this->webmoneyAccountNormalizer = $webmoneyAccountNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return TransferBeneficiary
     */
    public function mapToEntity($data)
    {
        $entity = new TransferBeneficiary();

        if (isset($data['type'])) {
            $entity->setType($data['type']);
        }
        if (isset($data['identifiers'])) {
            $entity->setIdentifiers($this->identifiersNormalizer->mapToEntity($data['identifiers']));
        }
        if (isset($data['name'])) {
            $entity->setName($data['name']);
        }
        if (isset($data['person_type'])) {
            $entity->setPersonType($data['person_type']);
        }
        if (isset($data['bank_account'])) {
            $entity->setBankAccount($this->bankAccountNormalizer->mapToEntity($data['bank_account']));
        }
        if (isset($data['tax_account'])) {
            $entity->setTaxAccount($this->taxAccountNormalizer->mapToEntity($data['tax_account']));
        }
        if (isset($data['paysera_account'])) {
            $entity->setPayseraAccount($this->payseraAccountNormalizer->mapToEntity($data['paysera_account']));
        }
        if (isset($data['payza_account'])) {
            $entity->setPayzaAccount($this->payzaAccountNormalizer->mapToEntity($data['payza_account']));
        }
        if (isset($data['webmoney_account'])) {
            $entity->setWebmoneyAccount($this->webmoneyAccountNormalizer->mapToEntity($data['webmoney_account']));
        }
        
        return $entity;
    }

    /**
     * @param TransferBeneficiary $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'type' => $entity->getType(),
            'identifiers' => $entity->getIdentifiers() !== null ? $this->identifiersNormalizer->mapFromEntity($entity->getIdentifiers()) : null,
            'name' => $entity->getName(),
            'person_type' => $entity->getPersonType(),
            'bank_account' => $entity->getBankAccount() !== null ? $this->bankAccountNormalizer->mapFromEntity($entity->getBankAccount()) : null,
            'tax_account' => $entity->getTaxAccount() !== null ? $this->taxAccountNormalizer->mapFromEntity($entity->getTaxAccount()) : null,
            'paysera_account' => $entity->getPayseraAccount() !== null ? $this->payseraAccountNormalizer->mapFromEntity($entity->getPayseraAccount()) : null,
            'payza_account' => $entity->getPayzaAccount() !== null ? $this->payzaAccountNormalizer->mapFromEntity($entity->getPayzaAccount()) : null,
            'webmoney_account' => $entity->getWebmoneyAccount() !== null ? $this->webmoneyAccountNormalizer->mapFromEntity($entity->getWebmoneyAccount()) : null,
            
        ];
    }
}
