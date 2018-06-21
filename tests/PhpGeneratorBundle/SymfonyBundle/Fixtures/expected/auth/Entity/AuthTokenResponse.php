<?php

namespace Vendor\Test\AuthApiBundle\Entity;

class AuthTokenResponse
{
    const TYPE_CHALLENGE = 'challenge';
    const TYPE_AUTH_TOKEN = 'auth_token';

    private $id;
    private $type;
    private $challenge;
    private $authToken;

    public function __construct()
    {
                
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * @return Challenge|null
     */
    public function getChallenge()
    {
        return $this->challenge;
    }
    /**
     * @param Challenge $challenge
     * @return $this
     */
    public function setChallenge(Challenge $challenge)
    {
        $this->challenge = $challenge;
        return $this;
    }
    /**
     * @return AuthToken|null
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }
    /**
     * @param AuthToken $authToken
     * @return $this
     */
    public function setAuthToken(AuthToken $authToken)
    {
        $this->authToken = $authToken;
        return $this;
    }

}
