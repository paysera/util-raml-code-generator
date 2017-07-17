<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class ConvertCurrency extends Entity
{
    /**
     * @return string
     */
    public function getFromCurrency()
    {
        return $this->get('from_currency');
    }
    /**
     * @param string $fromCurrency
     * @return $this
     */
    public function setFromCurrency($fromCurrency)
    {
        $this->set('from_currency', $fromCurrency);
        return $this;
    }
    /**
     * @return string
     */
    public function getToCurrency()
    {
        return $this->get('to_currency');
    }
    /**
     * @param string $toCurrency
     * @return $this
     */
    public function setToCurrency($toCurrency)
    {
        $this->set('to_currency', $toCurrency);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getToAmount()
    {
        return $this->get('to_amount');
    }
    /**
     * @param string $toAmount
     * @return $this
     */
    public function setToAmount($toAmount)
    {
        $this->set('to_amount', $toAmount);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getFromAmount()
    {
        return $this->get('from_amount');
    }
    /**
     * @param string $fromAmount
     * @return $this
     */
    public function setFromAmount($fromAmount)
    {
        $this->set('from_amount', $fromAmount);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getMinToAmount()
    {
        return $this->get('min_to_amount');
    }
    /**
     * @param string $minToAmount
     * @return $this
     */
    public function setMinToAmount($minToAmount)
    {
        $this->set('min_to_amount', $minToAmount);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getMaxFromAmount()
    {
        return $this->get('max_from_amount');
    }
    /**
     * @param string $maxFromAmount
     * @return $this
     */
    public function setMaxFromAmount($maxFromAmount)
    {
        $this->set('max_from_amount', $maxFromAmount);
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
}
