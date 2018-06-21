<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class TransferFailureStatus
{
    private $id;
    private $code;
    private $message;

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
    public function getCode()
    {
        return $this->code;
    }
    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

}
