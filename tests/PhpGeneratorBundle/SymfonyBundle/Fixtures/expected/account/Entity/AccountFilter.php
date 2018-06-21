<?php

namespace Vendor\Test\AccountApiBundle\Entity;

use Paysera\Component\Serializer\Entity\Filter;

class AccountFilter extends Filter
{
    private $type;
    private $administeredByUserId;
    private $ownedByUserId;
    private $closed;
    private $readableByClientId;
    private $active;

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * @return integer|null
     */
    public function getAdministeredByUserId()
    {
        return $this->administeredByUserId;
    }
    /**
     * @param integer $administeredByUserId
     * @return $this
     */
    public function setAdministeredByUserId($administeredByUserId)
    {
        $this->administeredByUserId = $administeredByUserId;
        return $this;
    }
    /**
     * @return integer|null
     */
    public function getOwnedByUserId()
    {
        return $this->ownedByUserId;
    }
    /**
     * @param integer $ownedByUserId
     * @return $this
     */
    public function setOwnedByUserId($ownedByUserId)
    {
        $this->ownedByUserId = $ownedByUserId;
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isClosed()
    {
        return $this->closed;
    }
    /**
     * @param boolean $closed
     * @return $this
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;
        return $this;
    }
    /**
     * @return integer|null
     */
    public function getReadableByClientId()
    {
        return $this->readableByClientId;
    }
    /**
     * @param integer $readableByClientId
     * @return $this
     */
    public function setReadableByClientId($readableByClientId)
    {
        $this->readableByClientId = $readableByClientId;
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isActive()
    {
        return $this->active;
    }
    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }
}
