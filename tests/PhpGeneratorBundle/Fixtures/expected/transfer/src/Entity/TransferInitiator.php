<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferInitiator extends Entity
{
    /**
     * @return string|null
     */
    public function getUserId()
    {
        return $this->get('user_id');
    }
    /**
     * @param string $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->set('user_id', $userId);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getClientId()
    {
        return $this->get('client_id');
    }
    /**
     * @param string $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->set('client_id', $clientId);
        return $this;
    }
}
