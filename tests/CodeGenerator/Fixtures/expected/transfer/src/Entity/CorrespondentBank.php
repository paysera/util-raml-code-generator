<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class CorrespondentBank extends Entity
{
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
}
