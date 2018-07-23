<?php

namespace Vendor\Test\UserInfoApiBundle\Entity;

class UserInfo
{
    const TYPE_LEGAL = 'legal';
    const TYPE_NATURAL = 'natural';

    private $id;
    private $type;
    private $createdTimestamp;
    private $createdDatetime;
    private $createdDateOnly;
    private $createdTimeOnly;
    private $createdDatetimeOnly;

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
     * @return \DateTime
     */
    public function getCreatedTimestamp()
    {
        return $this->createdTimestamp;
    }
    /**
     * @param \DateTimeInterface $createdTimestamp
     * @return $this
     */
    public function setCreatedTimestamp(\DateTimeInterface $createdTimestamp)
    {
        $this->createdTimestamp = $createdTimestamp;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getCreatedDatetime()
    {
        return $this->createdDatetime;
    }
    /**
     * @param \DateTimeInterface $createdDatetime
     * @return $this
     */
    public function setCreatedDatetime(\DateTimeInterface $createdDatetime)
    {
        $this->createdDatetime = $createdDatetime;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getCreatedDateOnly()
    {
        return $this->createdDateOnly;
    }
    /**
     * @param \DateTimeInterface $createdDateOnly
     * @return $this
     */
    public function setCreatedDateOnly(\DateTimeInterface $createdDateOnly)
    {
        $this->createdDateOnly = $createdDateOnly;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getCreatedTimeOnly()
    {
        return $this->createdTimeOnly;
    }
    /**
     * @param \DateTimeInterface $createdTimeOnly
     * @return $this
     */
    public function setCreatedTimeOnly(\DateTimeInterface $createdTimeOnly)
    {
        $this->createdTimeOnly = $createdTimeOnly;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getCreatedDatetimeOnly()
    {
        return $this->createdDatetimeOnly;
    }
    /**
     * @param \DateTimeInterface $createdDatetimeOnly
     * @return $this
     */
    public function setCreatedDatetimeOnly(\DateTimeInterface $createdDatetimeOnly)
    {
        $this->createdDatetimeOnly = $createdDatetimeOnly;
        return $this;
    }

}
