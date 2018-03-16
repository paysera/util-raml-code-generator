<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class ScopeChallenge extends Entity
{
    /**
     * @return string
     */
    public function getChallengeId()
    {
        return $this->get('challenge_id');
    }
    /**
     * @param string $challengeId
     * @return $this
     */
    public function setChallengeId($challengeId)
    {
        $this->set('challenge_id', $challengeId);
        return $this;
    }
}
