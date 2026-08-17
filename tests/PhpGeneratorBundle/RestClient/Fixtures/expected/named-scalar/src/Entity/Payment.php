<?php

namespace Paysera\Test\NamedScalarClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Payment extends Entity
{
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_USD = 'USD';
    const ALLOWED_CURRENCIES_EUR = 'EUR';
    const ALLOWED_CURRENCIES_USD = 'USD';
    const SCAN_RESULT_CLEAN = 'clean';
    const SCAN_RESULT_FLAGGED = 'flagged';
    const FILTER_MODE_STRICT = 'strict';
    const FILTER_MODE_LOOSE = 'loose';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->get('id');
    }
    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->set('id', $id);
        return $this;
    }
    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->get('currency');
    }
    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->set('currency', $currency);
        return $this;
    }
    /**
     * @return string[]|null
     */
    public function getAllowedCurrencies()
    {
        return $this->get('allowed_currencies');
    }
    /**
     * @param string[] $allowedCurrencies
     * @return $this
     */
    public function setAllowedCurrencies(array $allowedCurrencies)
    {
        $this->set('allowed_currencies', $allowedCurrencies);
        return $this;
    }
    /**
     * @return string
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
    public function getScanResult()
    {
        return $this->get('scan_result');
    }
    /**
     * @param string $scanResult
     * @return $this
     */
    public function setScanResult($scanResult)
    {
        $this->set('scan_result', $scanResult);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getFilterMode()
    {
        return $this->get('filter_mode');
    }
    /**
     * @param string $filterMode
     * @return $this
     */
    public function setFilterMode($filterMode)
    {
        $this->set('filter_mode', $filterMode);
        return $this;
    }
    /**
     * @return PaymentMetadata|null
     */
    public function getMetadata()
    {
        if ($this->get('metadata') === null) {
            return null;
        }
        return (new PaymentMetadata())->setDataByReference($this->getByReference('metadata'));
    }
    /**
     * @param PaymentMetadata $metadata
     * @return $this
     */
    public function setMetadata(PaymentMetadata $metadata)
    {
        $this->setByReference('metadata', $metadata->getDataByReference());
        return $this;
    }
    /**
     * @return SearchResultMetadata|null
     */
    public function getSearchMetadata()
    {
        if ($this->get('search_metadata') === null) {
            return null;
        }
        return (new SearchResultMetadata())->setDataByReference($this->getByReference('search_metadata'));
    }
    /**
     * @param SearchResultMetadata $searchMetadata
     * @return $this
     */
    public function setSearchMetadata(SearchResultMetadata $searchMetadata)
    {
        $this->setByReference('search_metadata', $searchMetadata->getDataByReference());
        return $this;
    }
}
