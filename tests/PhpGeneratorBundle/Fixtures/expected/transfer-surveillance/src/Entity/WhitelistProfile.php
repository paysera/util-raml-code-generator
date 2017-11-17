<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class WhitelistProfile extends Entity
{
    /**
     * @return integer
     */
    public function getBlacklistId()
    {
        return $this->get('blacklist_id');
    }
    /**
     * @param integer $blacklistId
     * @return $this
     */
    public function setBlacklistId($blacklistId)
    {
        $this->set('blacklist_id', $blacklistId);
        return $this;
    }
    /**
     * @return string
     */
    public function getExternalId()
    {
        return $this->get('external_id');
    }
    /**
     * @param string $externalId
     * @return $this
     */
    public function setExternalId($externalId)
    {
        $this->set('external_id', $externalId);
        return $this;
    }
}
