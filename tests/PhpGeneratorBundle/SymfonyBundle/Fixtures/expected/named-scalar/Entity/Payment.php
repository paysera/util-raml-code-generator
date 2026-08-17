<?php

namespace Vendor\Test\NamedScalarApiBundle\Entity;

class Payment
{
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_USD = 'USD';
    const ALLOWED_CURRENCIES_EUR = 'EUR';
    const ALLOWED_CURRENCIES_USD = 'USD';
    const SCAN_RESULT_CLEAN = 'clean';
    const SCAN_RESULT_FLAGGED = 'flagged';
    const FILTER_MODE_STRICT = 'strict';
    const FILTER_MODE_LOOSE = 'loose';

    private $id;
    private $currency;
    private $allowedCurrencies;
    private $accountNumber;
    private $scanResult;
    private $filterMode;
    private $metadata;
    private $searchMetadata;

    public function __construct()
    {
                
        $this->allowedCurrencies = [];                    
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
    public function getCurrency()
    {
        return $this->currency;
    }
    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }
    /**
     * @return string[]
     */
    public function getAllowedCurrencies()
    {
        return $this->allowedCurrencies;
    }
    /**
     * @param string[] $allowedCurrencies
     * @return $this
     */
    public function setAllowedCurrencies(array $allowedCurrencies)
    {
        $this->allowedCurrencies = $allowedCurrencies;
        return $this;
    }
    /**
     * @return string
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
    public function getScanResult()
    {
        return $this->scanResult;
    }
    /**
     * @param string $scanResult
     * @return $this
     */
    public function setScanResult($scanResult)
    {
        $this->scanResult = $scanResult;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getFilterMode()
    {
        return $this->filterMode;
    }
    /**
     * @param string $filterMode
     * @return $this
     */
    public function setFilterMode($filterMode)
    {
        $this->filterMode = $filterMode;
        return $this;
    }
    /**
     * @return PaymentMetadata|null
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
    /**
     * @param PaymentMetadata $metadata
     * @return $this
     */
    public function setMetadata(PaymentMetadata $metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }
    /**
     * @return SearchResultMetadata|null
     */
    public function getSearchMetadata()
    {
        return $this->searchMetadata;
    }
    /**
     * @param SearchResultMetadata $searchMetadata
     * @return $this
     */
    public function setSearchMetadata(SearchResultMetadata $searchMetadata)
    {
        $this->searchMetadata = $searchMetadata;
        return $this;
    }

}
