<?php

namespace Vendor\Test\AccountApiBundle\Entity;

class Account
{
    private $id;
    private $createdAt;
    private $number;
    private $active;
    private $clientId;
    private $closed;
    private $type;
    private $undescribed;

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
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }
    /**
     * @param string $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }
    /**
     * @return boolean
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
    /**
     * @return integer
     */
    public function getClientId()
    {
        return $this->clientId;
    }
    /**
     * @param integer $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }
    /**
     * @return boolean
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
     * @return string
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
     * @return UndescribedType
     */
    public function getUndescribed()
    {
        return $this->undescribed;
    }
    /**
     * @param UndescribedType $undescribed
     * @return $this
     */
    public function setUndescribed(UndescribedType $undescribed)
    {
        $this->undescribed = $undescribed;
        return $this;
    }

}
