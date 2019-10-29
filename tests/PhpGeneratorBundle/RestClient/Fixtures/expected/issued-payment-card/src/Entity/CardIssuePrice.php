<?php

namespace Paysera\Test\IssuedPaymentCardClient\Entity;

use Evp\Component\Money\Money;
use Paysera\Component\RestClientCommon\Entity\Entity;

class CardIssuePrice extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return Money
     */
    public function getPrice()
    {
        return new Money($this->get('price')['amount'], $this->get('price')['currency']);
    }
    /**
     * @param Money $price
     * @return $this
     */
    public function setPrice(Money $price)
    {
        $this->set('price', ['amount' => $price->getAmount(), 'currency' => $price->getCurrency()]);
        return $this;
    }
    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->get('country');
    }
    /**
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->set('country', $country);
        return $this;
    }
    /**
     * @return string
     */
    public function getClientType()
    {
        return $this->get('client_type');
    }
    /**
     * @param string $clientType
     * @return $this
     */
    public function setClientType($clientType)
    {
        $this->set('client_type', $clientType);
        return $this;
    }
}
