<?php

namespace Paysera\Test\AuthClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Challenge extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

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
