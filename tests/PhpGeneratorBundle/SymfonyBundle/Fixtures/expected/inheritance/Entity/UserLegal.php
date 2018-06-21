<?php

namespace Vendor\Test\InheritanceApiBundle\Entity;

class UserLegal extends User
{
    private $id;
    private $companyName;
    private $companyCode;
    private $vatCode;

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
    public function getCompanyName()
    {
        return $this->companyName;
    }
    /**
     * @param string $companyName
     * @return $this
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }
    /**
     * @return string
     */
    public function getCompanyCode()
    {
        return $this->companyCode;
    }
    /**
     * @param string $companyCode
     * @return $this
     */
    public function setCompanyCode($companyCode)
    {
        $this->companyCode = $companyCode;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getVatCode()
    {
        return $this->vatCode;
    }
    /**
     * @param string $vatCode
     * @return $this
     */
    public function setVatCode($vatCode)
    {
        $this->vatCode = $vatCode;
        return $this;
    }

}
