<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\TransferSurveillanceApiBundle\Entity\Rule;

class RuleNormalizer implements NormalizerInterface, DenormalizerInterface
{
    
    /**
     * @param array $data
     *
     * @return Rule
     */
    public function mapToEntity($data)
    {
        $entity = new Rule();

        if (isset($data['matcher_identifier'])) {
            $entity->setMatcherIdentifier($data['matcher_identifier']);
        }
        if (isset($data['title'])) {
            $entity->setTitle($data['title']);
        }
        if (isset($data['action'])) {
            $entity->setAction($data['action']);
        }
        if (isset($data['type'])) {
            $entity->setType($data['type']);
        }
        if (isset($data['status'])) {
            $entity->setStatus($data['status']);
        }
        if (isset($data['aml_details_needed'])) {
            $entity->setAmlDetailsNeeded($data['aml_details_needed']);
        }
        if (isset($data['related_bank_accounts_allowed'])) {
            $entity->setRelatedBankAccountsAllowed($data['related_bank_accounts_allowed']);
        }
        if (isset($data['description'])) {
            $entity->setDescription($data['description']);
        }
        if (isset($data['inform_prevention'])) {
            $entity->setInformPrevention($data['inform_prevention']);
        }
        
        return $entity;
    }

    /**
     * @param Rule $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'matcher_identifier' => $entity->getMatcherIdentifier(),
            'title' => $entity->getTitle(),
            'action' => $entity->getAction(),
            'type' => $entity->getType(),
            'status' => $entity->getStatus(),
            'aml_details_needed' => $entity->isAmlDetailsNeeded(),
            'related_bank_accounts_allowed' => $entity->isRelatedBankAccountsAllowed(),
            'description' => $entity->getDescription(),
            'inform_prevention' => $entity->isInformPrevention(),
            
        ];
    }
}
