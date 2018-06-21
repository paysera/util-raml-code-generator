<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class ConvertCurrency
{
    private $id;
    private $fromCurrency;
    private $toCurrency;
    private $toAmount;
    private $fromAmount;
    private $minToAmount;
    private $maxFromAmount;
    private $accountNumber;

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
    public function getFromCurrency()
    {
        return $this->fromCurrency;
    }
    /**
     * @param string $fromCurrency
     * @return $this
     */
    public function setFromCurrency($fromCurrency)
    {
        $this->fromCurrency = $fromCurrency;
        return $this;
    }
    /**
     * @return string
     */
    public function getToCurrency()
    {
        return $this->toCurrency;
    }
    /**
     * @param string $toCurrency
     * @return $this
     */
    public function setToCurrency($toCurrency)
    {
        $this->toCurrency = $toCurrency;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getToAmount()
    {
        return $this->toAmount;
    }
    /**
     * @param string $toAmount
     * @return $this
     */
    public function setToAmount($toAmount)
    {
        $this->toAmount = $toAmount;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getFromAmount()
    {
        return $this->fromAmount;
    }
    /**
     * @param string $fromAmount
     * @return $this
     */
    public function setFromAmount($fromAmount)
    {
        $this->fromAmount = $fromAmount;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getMinToAmount()
    {
        return $this->minToAmount;
    }
    /**
     * @param string $minToAmount
     * @return $this
     */
    public function setMinToAmount($minToAmount)
    {
        $this->minToAmount = $minToAmount;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getMaxFromAmount()
    {
        return $this->maxFromAmount;
    }
    /**
     * @param string $maxFromAmount
     * @return $this
     */
    public function setMaxFromAmount($maxFromAmount)
    {
        $this->maxFromAmount = $maxFromAmount;
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

}
