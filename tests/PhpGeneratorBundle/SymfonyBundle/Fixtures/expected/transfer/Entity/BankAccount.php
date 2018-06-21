<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class BankAccount
{
    private $id;
    private $iban;
    private $accountNumber;
    private $countryCode;
    private $bic;
    private $bankCode;
    private $bankAddress;
    private $bankTitle;
    private $correspondentBank;

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
    public function getIban()
    {
        return $this->iban;
    }
    /**
     * @param string $iban
     * @return $this
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
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
    public function getBic()
    {
        return $this->bic;
    }
    /**
     * @param string $bic
     * @return $this
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
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
    /**
     * @return Address|null
     */
    public function getBankAddress()
    {
        return $this->bankAddress;
    }
    /**
     * @param Address $bankAddress
     * @return $this
     */
    public function setBankAddress(Address $bankAddress)
    {
        $this->bankAddress = $bankAddress;
        return $this;
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
     * @return CorrespondentBank|null
     */
    public function getCorrespondentBank()
    {
        return $this->correspondentBank;
    }
    /**
     * @param CorrespondentBank $correspondentBank
     * @return $this
     */
    public function setCorrespondentBank(CorrespondentBank $correspondentBank)
    {
        $this->correspondentBank = $correspondentBank;
        return $this;
    }

}
