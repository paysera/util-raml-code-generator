<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferPassword extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

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
