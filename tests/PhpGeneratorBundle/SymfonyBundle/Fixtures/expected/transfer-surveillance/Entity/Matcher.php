<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Entity;

class Matcher
{
    private $id;
    private $identifier;
    private $description;

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
    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

}
