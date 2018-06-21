<?php

namespace Vendor\Test\AuthApiBundle\Entity;

class SystemTokenResponse
{
    const TYPE_SCOPE_CHALLENGE = 'scope_challenge';
    const TYPE_SYSTEM_TOKEN = 'system_token';

    private $id;
    private $type;
    private $scopeChallenge;
    private $systemToken;

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
     * @return ScopeChallenge|null
     */
    public function getScopeChallenge()
    {
        return $this->scopeChallenge;
    }
    /**
     * @param ScopeChallenge $scopeChallenge
     * @return $this
     */
    public function setScopeChallenge(ScopeChallenge $scopeChallenge)
    {
        $this->scopeChallenge = $scopeChallenge;
        return $this;
    }
    /**
     * @return SystemToken|null
     */
    public function getSystemToken()
    {
        return $this->systemToken;
    }
    /**
     * @param SystemToken $systemToken
     * @return $this
     */
    public function setSystemToken(SystemToken $systemToken)
    {
        $this->systemToken = $systemToken;
        return $this;
    }

}
