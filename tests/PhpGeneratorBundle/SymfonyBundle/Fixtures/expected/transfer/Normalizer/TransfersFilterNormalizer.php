<?php

namespace Vendor\Test\TransferApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\FilterNormalizer;
use Vendor\Test\TransferApiBundle\Entity\TransfersFilter;

class TransfersFilterNormalizer extends FilterNormalizer
{
    /**
     * @param array $data
     *
     * @return TransfersFilter
     */
    public function mapToEntity($data)
    {
        $entity = new TransfersFilter();
        $this->mapBaseKeys($data, $entity);

        if (isset($data['created_date_from'])) {
            $entity->setCreatedDateFrom((new \DateTime())->setTimestamp($data['created_date_from']));
        }
        if (isset($data['created_date_to'])) {
            $entity->setCreatedDateTo((new \DateTime())->setTimestamp($data['created_date_to']));
        }
        if (isset($data['credit_account_number'])) {
            $entity->setCreditAccountNumber($data['credit_account_number']);
        }
        if (isset($data['debit_account_number'])) {
            $entity->setDebitAccountNumber($data['debit_account_number']);
        }
        if (isset($data['statuses'])) {
            $entity->setStatuses($data['statuses']);
        }
        
        return $entity;
    }

    /**
     * @param TransfersFilter $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        $data = parent::mapFromEntity($entity);
        return array_merge(
            $data,
            [
                'created_date_from' => $entity->getCreatedDateFrom() !== null ? $entity->getCreatedDateFrom()->getTimestamp() : null,
                'created_date_to' => $entity->getCreatedDateTo() !== null ? $entity->getCreatedDateTo()->getTimestamp() : null,
                'credit_account_number' => $entity->getCreditAccountNumber(),
                'debit_account_number' => $entity->getDebitAccountNumber(),
                'statuses' => $entity->getStatuses(),
                
            ]
        );
        
    }
}
