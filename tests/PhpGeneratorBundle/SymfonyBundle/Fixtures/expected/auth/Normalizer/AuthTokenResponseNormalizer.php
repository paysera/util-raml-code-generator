<?php

namespace Vendor\Test\AuthApiBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\AuthApiBundle\Entity\AuthTokenResponse;

class AuthTokenResponseNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $challengeNormalizer;
    private $authTokenNormalizer;
    
    public function __construct(
        ChallengeNormalizer $challengeNormalizer,
        AuthTokenNormalizer $authTokenNormalizer
    ) {
        $this->challengeNormalizer = $challengeNormalizer;
        $this->authTokenNormalizer = $authTokenNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return AuthTokenResponse
     */
    public function mapToEntity($data)
    {
        $entity = new AuthTokenResponse();

        if (isset($data['type'])) {
            $entity->setType($data['type']);
        }
        if (isset($data['challenge'])) {
            $entity->setChallenge($this->challengeNormalizer->mapToEntity($data['challenge']));
        }
        if (isset($data['auth_token'])) {
            $entity->setAuthToken($this->authTokenNormalizer->mapToEntity($data['auth_token']));
        }
        
        return $entity;
    }

    /**
     * @param AuthTokenResponse $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'type' => $entity->getType(),
            'challenge' => $entity->getChallenge() !== null ? $this->challengeNormalizer->mapFromEntity($entity->getChallenge()) : null,
            'auth_token' => $entity->getAuthToken() !== null ? $this->authTokenNormalizer->mapFromEntity($entity->getAuthToken()) : null,
            
        ];
    }
}
