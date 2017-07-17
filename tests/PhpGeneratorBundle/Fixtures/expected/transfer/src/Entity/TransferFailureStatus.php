<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferFailureStatus extends Entity
{
    /**
     * @return string|null
     */
    public function getCode()
    {
        return $this->get('code');
    }
    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->set('code', $code);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getMessage()
    {
        return $this->get('message');
    }
    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->set('message', $message);
        return $this;
    }
}
