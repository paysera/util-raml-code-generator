<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferApiBundle\Entity\CorrespondentBank;

class CorrespondentBankNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return CorrespondentBank
     */
    public function mapToEntity($data)
    {
        $entity = new CorrespondentBank();

        if (isset($data['bank_title'])) {
            $entity->setBankTitle($data['bank_title']);
        }
        if (isset($data['account_number'])) {
            $entity->setAccountNumber($data['account_number']);
        }
        if (isset($data['bank_code'])) {
            $entity->setBankCode($data['bank_code']);
        }
        
        return $entity;
    }

    /**
     * @param CorrespondentBank $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'bank_title' => $entity->getBankTitle(),
            'account_number' => $entity->getAccountNumber(),
            'bank_code' => $entity->getBankCode(),
            
        ];
    }
}
