<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class SystemTokenResponse extends Entity
{
    const TYPE_SCOPE_CHALLENGE = 'scope_challenge';
    const TYPE_SYSTEM_TOKEN = 'system_token';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

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
     * @return ScopeChallenge|null
     */
    public function getScopeChallenge()
    {
        return (new ScopeChallenge())->setDataByReference($this->getByReference('scope_challenge'));
    }
    /**
     * @param ScopeChallenge $scopeChallenge
     * @return $this
     */
    public function setScopeChallenge(ScopeChallenge $scopeChallenge)
    {
        $this->setByReference('scope_challenge', $scopeChallenge->getDataByReference());
        return $this;
    }
    /**
     * @return SystemToken|null
     */
    public function getSystemToken()
    {
        return (new SystemToken())->setDataByReference($this->getByReference('system_token'));
    }
    /**
     * @param SystemToken $systemToken
     * @return $this
     */
    public function setSystemToken(SystemToken $systemToken)
    {
        $this->setByReference('system_token', $systemToken->getDataByReference());
        return $this;
    }
}
