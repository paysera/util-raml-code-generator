<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class CorrespondentBank
{
    private $id;
    private $bankTitle;
    private $accountNumber;
    private $bankCode;

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
    public function getBankTitle()
    {
        return $this->bankTitle;
    }
    /**
     * @param string $bankTitle
     * @return $this
     */
    public function setBankTitle($bankTitle)
    {
        $this->bankTitle = $bankTitle;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }
    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }
    /**
     * @param string $bankCode
     * @return $this
     */
    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;
        return $this;
    }

}
