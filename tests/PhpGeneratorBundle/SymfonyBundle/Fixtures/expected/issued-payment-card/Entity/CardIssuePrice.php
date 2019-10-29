<?php

namespace Vendor\Test\IssuedPaymentCardApiBundle\Entity;

use Evp\Component\Money\Money;

class CardIssuePrice
{
    private $id;
    private $priceAmount;
    private $priceCurrency;
    private $country;
    private $clientType;

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
     * @return Money
     */
    public function getPrice()
    {
        return new Money($this->priceAmount, $this->priceCurrency);
    }
    /**
     * @param Money $price
     * @return $this
     */
    public function setPrice(Money $price)
    {
        $this->priceAmount = $price->getAmount();
        $this->priceCurrency = $price->getCurrency();
        return $this;
    }
    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
    /**
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }
    /**
     * @return string
     */
    public function getClientType()
    {
        return $this->clientType;
    }
    /**
     * @param string $clientType
     * @return $this
     */
    public function setClientType($clientType)
    {
        $this->clientType = $clientType;
        return $this;
    }

}
