<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\BankAccount;

class BankAccountNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $addressNormalizer;
    private $correspondentBankNormalizer;
    
    public function __construct(
        AddressNormalizer $addressNormalizer,
        CorrespondentBankNormalizer $correspondentBankNormalizer
    ) {
        $this->addressNormalizer = $addressNormalizer;
        $this->correspondentBankNormalizer = $correspondentBankNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return BankAccount
     */
    public function mapToEntity($data)
    {
        $entity = new BankAccount();

        if (isset($data['iban'])) {
            $entity->setIban($data['iban']);
        }
        if (isset($data['account_number'])) {
            $entity->setAccountNumber($data['account_number']);
        }
        if (isset($data['country_code'])) {
            $entity->setCountryCode($data['country_code']);
        }
        if (isset($data['bic'])) {
            $entity->setBic($data['bic']);
        }
        if (isset($data['bank_code'])) {
            $entity->setBankCode($data['bank_code']);
        }
        if (isset($data['bank_address'])) {
            $entity->setBankAddress($this->addressNormalizer->mapToEntity($data['bank_address']));
        }
        if (isset($data['bank_title'])) {
            $entity->setBankTitle($data['bank_title']);
        }
        if (isset($data['correspondent_bank'])) {
            $entity->setCorrespondentBank($this->correspondentBankNormalizer->mapToEntity($data['correspondent_bank']));
        }
        
        return $entity;
    }

    /**
     * @param BankAccount $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'iban' => $entity->getIban(),
            'account_number' => $entity->getAccountNumber(),
            'country_code' => $entity->getCountryCode(),
            'bic' => $entity->getBic(),
            'bank_code' => $entity->getBankCode(),
            'bank_address' => $entity->getBankAddress() !== null ? $this->addressNormalizer->mapFromEntity($entity->getBankAddress()) : null,
            'bank_title' => $entity->getBankTitle(),
            'correspondent_bank' => $entity->getCorrespondentBank() !== null ? $this->correspondentBankNormalizer->mapFromEntity($entity->getCorrespondentBank()) : null,
            
        ];
    }
}
