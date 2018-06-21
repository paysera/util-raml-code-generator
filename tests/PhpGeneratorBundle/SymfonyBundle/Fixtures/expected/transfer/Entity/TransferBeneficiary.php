<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class TransferBeneficiary
{
    const TYPE_PAYSERA = 'paysera';
    const TYPE_PAYZA = 'payza';
    const TYPE_WEBMONEY = 'webmoney';
    const TYPE_TAX = 'tax';
    const TYPE_BANK = 'bank';
    const PERSON_TYPE_NATURAL = 'natural';
    const PERSON_TYPE_LEGAL = 'legal';

    private $id;
    private $type;
    private $identifiers;
    private $name;
    private $personType;
    private $bankAccount;
    private $taxAccount;
    private $payseraAccount;
    private $payzaAccount;
    private $webmoneyAccount;

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
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * @return Identifiers|null
     */
    public function getIdentifiers()
    {
        return $this->identifiers;
    }
    /**
     * @param Identifiers $identifiers
     * @return $this
     */
    public function setIdentifiers(Identifiers $identifiers)
    {
        $this->identifiers = $identifiers;
        return $this;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPersonType()
    {
        return $this->personType;
    }
    /**
     * @param string $personType
     * @return $this
     */
    public function setPersonType($personType)
    {
        $this->personType = $personType;
        return $this;
    }
    /**
     * @return BankAccount|null
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }
    /**
     * @param BankAccount $bankAccount
     * @return $this
     */
    public function setBankAccount(BankAccount $bankAccount)
    {
        $this->bankAccount = $bankAccount;
        return $this;
    }
    /**
     * @return TaxAccount|null
     */
    public function getTaxAccount()
    {
        return $this->taxAccount;
    }
    /**
     * @param TaxAccount $taxAccount
     * @return $this
     */
    public function setTaxAccount(TaxAccount $taxAccount)
    {
        $this->taxAccount = $taxAccount;
        return $this;
    }
    /**
     * @return PayseraAccount|null
     */
    public function getPayseraAccount()
    {
        return $this->payseraAccount;
    }
    /**
     * @param PayseraAccount $payseraAccount
     * @return $this
     */
    public function setPayseraAccount(PayseraAccount $payseraAccount)
    {
        $this->payseraAccount = $payseraAccount;
        return $this;
    }
    /**
     * @return PayzaAccount|null
     */
    public function getPayzaAccount()
    {
        return $this->payzaAccount;
    }
    /**
     * @param PayzaAccount $payzaAccount
     * @return $this
     */
    public function setPayzaAccount(PayzaAccount $payzaAccount)
    {
        $this->payzaAccount = $payzaAccount;
        return $this;
    }
    /**
     * @return WebmoneyAccount|null
     */
    public function getWebmoneyAccount()
    {
        return $this->webmoneyAccount;
    }
    /**
     * @param WebmoneyAccount $webmoneyAccount
     * @return $this
     */
    public function setWebmoneyAccount(WebmoneyAccount $webmoneyAccount)
    {
        $this->webmoneyAccount = $webmoneyAccount;
        return $this;
    }

}
