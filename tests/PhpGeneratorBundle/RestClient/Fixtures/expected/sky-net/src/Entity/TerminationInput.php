<?php

namespace Paysera\Test\SkyNetClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TerminationInput extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getTargetName()
    {
        return $this->get('target_name');
    }
    /**
     * @param string $targetName
     * @return $this
     */
    public function setTargetName($targetName)
    {
        $this->set('target_name', $targetName);
        return $this;
    }
}
