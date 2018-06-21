<?php

namespace Vendor\Test\AuthApiBundle\Entity;

class ScopeChallenge
{
    private $id;
    private $challengeId;

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
    public function getChallengeId()
    {
        return $this->challengeId;
    }
    /**
     * @param string $challengeId
     * @return $this
     */
    public function setChallengeId($challengeId)
    {
        $this->challengeId = $challengeId;
        return $this;
    }

}
