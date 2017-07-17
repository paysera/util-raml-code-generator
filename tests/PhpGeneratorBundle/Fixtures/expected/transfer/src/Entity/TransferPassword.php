<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferPassword extends Entity
{
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->get('password');
    }
    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->set('password', $password);
        return $this;
    }
}
