<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferBeneficiary extends Entity
{
    /**
     * @return string
     */
    public function getType()
    {
        return $this->get('type');
    }
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->set('type', $type);
        return $this;
    }
    /**
     * @return Identifiers|null
     */
    public function getIdentifiers()
    {
        return (new Identifiers())->setDataByReference($this->getByReference('identifiers'));
    }
    /**
     * @param Identifiers $identifiers
     * @return $this
     */
    public function setIdentifiers(Identifiers $identifiers)
    {
        $this->setByReference('identifiers', $identifiers->getDataByReference());
        return $this;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->get('name');
    }
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->set('name', $name);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPersonType()
    {
        return $this->get('person_type');
    }
    /**
     * @param string $personType
     * @return $this
     */
    public function setPersonType($personType)
    {
        $this->set('person_type', $personType);
        return $this;
    }
    /**
     * @return BankAccount|null
     */
    public function getBankAccount()
    {
        return (new BankAccount())->setDataByReference($this->getByReference('bank_account'));
    }
    /**
     * @param BankAccount $bankAccount
     * @return $this
     */
    public function setBankAccount(BankAccount $bankAccount)
    {
        $this->setByReference('bank_account', $bankAccount->getDataByReference());
        return $this;
    }
    /**
     * @return TaxAccount|null
     */
    public function getTaxAccount()
    {
        return (new TaxAccount())->setDataByReference($this->getByReference('tax_account'));
    }
    /**
     * @param TaxAccount $taxAccount
     * @return $this
     */
    public function setTaxAccount(TaxAccount $taxAccount)
    {
        $this->setByReference('tax_account', $taxAccount->getDataByReference());
        return $this;
    }
    /**
     * @return PayseraAccount|null
     */
    public function getPayseraAccount()
    {
        return (new PayseraAccount())->setDataByReference($this->getByReference('paysera_account'));
    }
    /**
     * @param PayseraAccount $payseraAccount
     * @return $this
     */
    public function setPayseraAccount(PayseraAccount $payseraAccount)
    {
        $this->setByReference('paysera_account', $payseraAccount->getDataByReference());
        return $this;
    }
    /**
     * @return PayzaAccount|null
     */
    public function getPayzaAccount()
    {
        return (new PayzaAccount())->setDataByReference($this->getByReference('payza_account'));
    }
    /**
     * @param PayzaAccount $payzaAccount
     * @return $this
     */
    public function setPayzaAccount(PayzaAccount $payzaAccount)
    {
        $this->setByReference('payza_account', $payzaAccount->getDataByReference());
        return $this;
    }
    /**
     * @return WebmoneyAccount|null
     */
    public function getWebmoneyAccount()
    {
        return (new WebmoneyAccount())->setDataByReference($this->getByReference('webmoney_account'));
    }
    /**
     * @param WebmoneyAccount $webmoneyAccount
     * @return $this
     */
    public function setWebmoneyAccount(WebmoneyAccount $webmoneyAccount)
    {
        $this->setByReference('webmoney_account', $webmoneyAccount->getDataByReference());
        return $this;
    }
}
