<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TaxAccount extends Entity
{
    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->get('identifier');
    }
    /**
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->set('identifier', $identifier);
        return $this;
    }
}
