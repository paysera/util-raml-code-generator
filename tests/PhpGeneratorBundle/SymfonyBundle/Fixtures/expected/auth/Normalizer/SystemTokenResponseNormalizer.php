<?php

namespace Vendor\Test\AuthApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\AuthApiBundle\Entity\SystemTokenResponse;

class SystemTokenResponseNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $scopeChallengeNormalizer;
    private $systemTokenNormalizer;
    
    public function __construct(
        ScopeChallengeNormalizer $scopeChallengeNormalizer,
        SystemTokenNormalizer $systemTokenNormalizer
    ) {
        $this->scopeChallengeNormalizer = $scopeChallengeNormalizer;
        $this->systemTokenNormalizer = $systemTokenNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return SystemTokenResponse
     */
    public function mapToEntity($data)
    {
        $entity = new SystemTokenResponse();

        if (isset($data['type'])) {
            $entity->setType($data['type']);
        }
        if (isset($data['scope_challenge'])) {
            $entity->setScopeChallenge($this->scopeChallengeNormalizer->mapToEntity($data['scope_challenge']));
        }
        if (isset($data['system_token'])) {
            $entity->setSystemToken($this->systemTokenNormalizer->mapToEntity($data['system_token']));
        }
        
        return $entity;
    }

    /**
     * @param SystemTokenResponse $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'type' => $entity->getType(),
            'scope_challenge' => $entity->getScopeChallenge() !== null ? $this->scopeChallengeNormalizer->mapFromEntity($entity->getScopeChallenge()) : null,
            'system_token' => $entity->getSystemToken() !== null ? $this->systemTokenNormalizer->mapFromEntity($entity->getSystemToken()) : null,
            
        ];
    }
}
