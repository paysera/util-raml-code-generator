<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class TransferPassword34
{
    const STATUS_PENDING = 'pending';
    const STATUS_UNLOCKED = 'unlocked';

    private $id;
    private $status;
    private $value;

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
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

}
