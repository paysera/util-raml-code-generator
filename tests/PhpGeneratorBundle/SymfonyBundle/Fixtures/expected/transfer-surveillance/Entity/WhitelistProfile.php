<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Entity;

class WhitelistProfile
{
    private $id;
    private $blacklistId;
    private $externalId;

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
     * @return integer
     */
    public function getBlacklistId()
    {
        return $this->blacklistId;
    }
    /**
     * @param integer $blacklistId
     * @return $this
     */
    public function setBlacklistId($blacklistId)
    {
        $this->blacklistId = $blacklistId;
        return $this;
    }
    /**
     * @return string
     */
    public function getExternalId()
    {
        return $this->externalId;
    }
    /**
     * @param string $externalId
     * @return $this
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;
        return $this;
    }

}
