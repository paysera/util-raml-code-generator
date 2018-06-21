<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class TaxAccount
{
    private $id;
    private $identifier;

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
    public function getIdentifier()
    {
        return $this->identifier;
    }
    /**
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

}
