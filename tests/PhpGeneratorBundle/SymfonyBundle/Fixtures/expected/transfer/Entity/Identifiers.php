<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class Identifiers
{
    private $id;
    private $general;
    private $personalCode;
    private $legalCode;
    private $taxCode;
    private $kppCode;

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
    public function getGeneral()
    {
        return $this->general;
    }
    /**
     * @param string $general
     * @return $this
     */
    public function setGeneral($general)
    {
        $this->general = $general;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPersonalCode()
    {
        return $this->personalCode;
    }
    /**
     * @param string $personalCode
     * @return $this
     */
    public function setPersonalCode($personalCode)
    {
        $this->personalCode = $personalCode;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getLegalCode()
    {
        return $this->legalCode;
    }
    /**
     * @param string $legalCode
     * @return $this
     */
    public function setLegalCode($legalCode)
    {
        $this->legalCode = $legalCode;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getTaxCode()
    {
        return $this->taxCode;
    }
    /**
     * @param string $taxCode
     * @return $this
     */
    public function setTaxCode($taxCode)
    {
        $this->taxCode = $taxCode;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getKppCode()
    {
        return $this->kppCode;
    }
    /**
     * @param string $kppCode
     * @return $this
     */
    public function setKppCode($kppCode)
    {
        $this->kppCode = $kppCode;
        return $this;
    }

}
