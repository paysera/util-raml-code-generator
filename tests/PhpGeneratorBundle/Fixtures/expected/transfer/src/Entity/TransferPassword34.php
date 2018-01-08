<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferPassword34 extends Entity
{
    const STATUS_PENDING = 'pending';
    const STATUS_UNLOCKED = 'unlocked';

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status');
    }
    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->set('status', $status);
        return $this;
    }
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
