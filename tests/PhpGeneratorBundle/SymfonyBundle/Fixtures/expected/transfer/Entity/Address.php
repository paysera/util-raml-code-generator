<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class Address
{
    private $id;
    private $countryCode;
    private $addressLine;

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
    public function getCountryCode()
    {
        return $this->countryCode;
    }
    /**
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getAddressLine()
    {
        return $this->addressLine;
    }
    /**
     * @param string $addressLine
     * @return $this
     */
    public function setAddressLine($addressLine)
    {
        $this->addressLine = $addressLine;
        return $this;
    }

}
