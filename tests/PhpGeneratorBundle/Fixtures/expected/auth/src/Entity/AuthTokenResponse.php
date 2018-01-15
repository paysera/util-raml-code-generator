<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class AuthTokenResponse extends Entity
{
    const TYPE_CHALLENGE = 'challenge';
    const TYPE_AUTH_TOKEN = 'auth_token';

    /**
     * @return string
     */
    public function getType()
    {
        return $this->get('type');
    }
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->set('type', $type);
        return $this;
    }
    /**
     * @return Challenge|null
     */
    public function getChallenge()
    {
        return (new Challenge())->setDataByReference($this->getByReference('challenge'));
    }
    /**
     * @param Challenge $challenge
     * @return $this
     */
    public function setChallenge(Challenge $challenge)
    {
        $this->setByReference('challenge', $challenge->getDataByReference());
        return $this;
    }
    /**
     * @return AuthToken|null
     */
    public function getAuthToken()
    {
        return (new AuthToken())->setDataByReference($this->getByReference('auth_token'));
    }
    /**
     * @param AuthToken $authToken
     * @return $this
     */
    public function setAuthToken(AuthToken $authToken)
    {
        $this->setByReference('auth_token', $authToken->getDataByReference());
        return $this;
    }
}
