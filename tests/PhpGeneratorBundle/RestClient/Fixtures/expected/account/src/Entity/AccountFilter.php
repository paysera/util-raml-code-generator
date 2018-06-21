<?php

namespace Paysera\Test\AccountClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Filter;

class AccountFilter extends Filter
{
    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->get('type');
    }
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->set('type', $type);
        return $this;
    }
    /**
     * @return integer|null
     */
    public function getAdministeredByUserId()
    {
        return $this->get('administered_by_user_id');
    }
    /**
     * @param integer $administeredByUserId
     * @return $this
     */
    public function setAdministeredByUserId($administeredByUserId)
    {
        $this->set('administered_by_user_id', $administeredByUserId);
        return $this;
    }
    /**
     * @return integer|null
     */
    public function getOwnedByUserId()
    {
        return $this->get('owned_by_user_id');
    }
    /**
     * @param integer $ownedByUserId
     * @return $this
     */
    public function setOwnedByUserId($ownedByUserId)
    {
        $this->set('owned_by_user_id', $ownedByUserId);
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isClosed()
    {
        return $this->get('closed');
    }
    /**
     * @param boolean $closed
     * @return $this
     */
    public function setClosed($closed)
    {
        $this->set('closed', $closed);
        return $this;
    }
    /**
     * @return integer|null
     */
    public function getReadableByClientId()
    {
        return $this->get('readable_by_client_id');
    }
    /**
     * @param integer $readableByClientId
     * @return $this
     */
    public function setReadableByClientId($readableByClientId)
    {
        $this->set('readable_by_client_id', $readableByClientId);
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isActive()
    {
        return $this->get('active');
    }
    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->set('active', $active);
        return $this;
    }
}
