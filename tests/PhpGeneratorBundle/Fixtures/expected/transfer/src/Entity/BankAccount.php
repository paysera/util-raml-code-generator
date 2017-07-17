<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class BankAccount extends Entity
{
    /**
     * @return string|null
     */
    public function getIban()
    {
        return $this->get('iban');
    }
    /**
     * @param string $iban
     * @return $this
     */
    public function setIban($iban)
    {
        $this->set('iban', $iban);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getAccountNumber()
    {
        return $this->get('account_number');
    }
    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber($accountNumber)
    {
        $this->set('account_number', $accountNumber);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getCountryCode()
    {
        return $this->get('country_code');
    }
    /**
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->set('country_code', $countryCode);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getBic()
    {
        return $this->get('bic');
    }
    /**
     * @param string $bic
     * @return $this
     */
    public function setBic($bic)
    {
        $this->set('bic', $bic);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getBankCode()
    {
        return $this->get('bank_code');
    }
    /**
     * @param string $bankCode
     * @return $this
     */
    public function setBankCode($bankCode)
    {
        $this->set('bank_code', $bankCode);
        return $this;
    }
    /**
     * @return Address|null
     */
    public function getBankAddress()
    {
        return (new Address())->setDataByReference($this->getByReference('bank_address'));
    }
    /**
     * @param Address $bankAddress
     * @return $this
     */
    public function setBankAddress(Address $bankAddress)
    {
        $this->setByReference('bank_address', $bankAddress->getDataByReference());
        return $this;
    }
    /**
     * @return string|null
     */
    public function getBankTitle()
    {
        return $this->get('bank_title');
    }
    /**
     * @param string $bankTitle
     * @return $this
     */
    public function setBankTitle($bankTitle)
    {
        $this->set('bank_title', $bankTitle);
        return $this;
    }
    /**
     * @return CorrespondentBank|null
     */
    public function getCorrespondentBank()
    {
        return (new CorrespondentBank())->setDataByReference($this->getByReference('correspondent_bank'));
    }
    /**
     * @param CorrespondentBank $correspondentBank
     * @return $this
     */
    public function setCorrespondentBank(CorrespondentBank $correspondentBank)
    {
        $this->setByReference('correspondent_bank', $correspondentBank->getDataByReference());
        return $this;
    }
}
