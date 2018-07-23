<?php

namespace Paysera\Test\UserInfoClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class UserInfo extends Entity
{
    const TYPE_LEGAL = 'legal';
    const TYPE_NATURAL = 'natural';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->get('id');
    }
    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->set('id', $id);
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
     * @return \DateTimeImmutable
     */
    public function getCreatedTimestamp()
    {
        return (new \DateTimeImmutable())->setTimestamp($this->get('created_timestamp'));
    }
    /**
     * @param \DateTimeInterface $createdTimestamp
     * @return $this
     */
    public function setCreatedTimestamp(\DateTimeInterface $createdTimestamp)
    {
        $this->set('created_timestamp', $createdTimestamp->getTimestamp());
        return $this;
    }
    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedDatetime()
    {
        if ($this->get('created_datetime') === null) {
            return null;
        }
        return \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:sP', $this->get('created_datetime'));
    }
    /**
     * @param \DateTimeInterface $createdDatetime
     * @return $this
     */
    public function setCreatedDatetime(\DateTimeInterface $createdDatetime)
    {
        $this->set('created_datetime', $createdDatetime->format('Y-m-d\TH:i:sP'));
        return $this;
    }
    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedDateOnly()
    {
        if ($this->get('created_date_only') === null) {
            return null;
        }
        return \DateTimeImmutable::createFromFormat('Y-m-d', $this->get('created_date_only'));
    }
    /**
     * @param \DateTimeInterface $createdDateOnly
     * @return $this
     */
    public function setCreatedDateOnly(\DateTimeInterface $createdDateOnly)
    {
        $this->set('created_date_only', $createdDateOnly->format('Y-m-d'));
        return $this;
    }
    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedTimeOnly()
    {
        if ($this->get('created_time_only') === null) {
            return null;
        }
        return \DateTimeImmutable::createFromFormat('H:i:s', $this->get('created_time_only'));
    }
    /**
     * @param \DateTimeInterface $createdTimeOnly
     * @return $this
     */
    public function setCreatedTimeOnly(\DateTimeInterface $createdTimeOnly)
    {
        $this->set('created_time_only', $createdTimeOnly->format('H:i:s'));
        return $this;
    }
    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedDatetimeOnly()
    {
        if ($this->get('created_datetime_only') === null) {
            return null;
        }
        return \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s', $this->get('created_datetime_only'));
    }
    /**
     * @param \DateTimeInterface $createdDatetimeOnly
     * @return $this
     */
    public function setCreatedDatetimeOnly(\DateTimeInterface $createdDatetimeOnly)
    {
        $this->set('created_datetime_only', $createdDatetimeOnly->format('Y-m-d\TH:i:s'));
        return $this;
    }
}
