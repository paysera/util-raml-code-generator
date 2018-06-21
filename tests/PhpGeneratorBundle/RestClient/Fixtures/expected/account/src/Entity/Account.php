<?php

namespace Paysera\Test\AccountClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Account extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt()
    {
        return (new \DateTimeImmutable())->setTimestamp($this->get('created_at'));
    }
    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->set('created_at', $createdAt->getTimestamp());
        return $this;
    }
    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->get('number');
    }
    /**
     * @param string $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->set('number', $number);
        return $this;
    }
    /**
     * @return boolean
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
    /**
     * @return integer
     */
    public function getClientId()
    {
        return $this->get('client_id');
    }
    /**
     * @param integer $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->set('client_id', $clientId);
        return $this;
    }
    /**
     * @return boolean
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
     * @return string
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
     * @return UndescribedType
     */
    public function getUndescribed()
    {
        return (new UndescribedType())->setDataByReference($this->getByReference('undescribed'));
    }
    /**
     * @param UndescribedType $undescribed
     * @return $this
     */
    public function setUndescribed(UndescribedType $undescribed)
    {
        $this->setByReference('undescribed', $undescribed->getDataByReference());
        return $this;
    }
}
