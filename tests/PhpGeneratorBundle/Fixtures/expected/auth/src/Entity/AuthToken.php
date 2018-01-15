<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class AuthToken extends Entity
{
    /**
     * @return string
     */
    public function getValue()
    {
        return $this->get('value');
    }
    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->set('value', $value);
        return $this;
    }
}
