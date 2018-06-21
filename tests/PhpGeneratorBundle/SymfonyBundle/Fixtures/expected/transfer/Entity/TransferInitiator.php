<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class TransferInitiator
{
    private $id;
    private $userId;
    private $clientId;

    public function __construct()
    {
            
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string|null
     */
    public function getUserId()
    {
        return $this->userId;
    }
    /**
     * @param string $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getClientId()
    {
        return $this->clientId;
    }
    /**
     * @param string $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

}
