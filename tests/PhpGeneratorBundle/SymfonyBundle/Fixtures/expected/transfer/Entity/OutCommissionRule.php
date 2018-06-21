<?php

namespace Vendor\Test\TransferApiBundle\Entity;

use Evp\Component\Money\Money;

class OutCommissionRule
{
    private $id;
    private $percent;
    private $minAmount;
    private $minCurrency;
    private $maxAmount;
    private $maxCurrency;
    private $fixAmount;
    private $fixCurrency;

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
     * @return string|null
     */
    public function getPercent()
    {
        return $this->percent;
    }
    /**
     * @param string $percent
     * @return $this
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getMin()
    {
        if ($this->minAmount === null && $this->minCurrency === null) {
            return null;
        }
        return new Money($this->minAmount, $this->minCurrency);
    }
    /**
     * @param Money $min
     * @return $this
     */
    public function setMin(Money $min)
    {
        $this->minAmount = $min->getAmount();
        $this->minCurrency = $min->getCurrency();
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getMax()
    {
        if ($this->maxAmount === null && $this->maxCurrency === null) {
            return null;
        }
        return new Money($this->maxAmount, $this->maxCurrency);
    }
    /**
     * @param Money $max
     * @return $this
     */
    public function setMax(Money $max)
    {
        $this->maxAmount = $max->getAmount();
        $this->maxCurrency = $max->getCurrency();
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getFix()
    {
        if ($this->fixAmount === null && $this->fixCurrency === null) {
            return null;
        }
        return new Money($this->fixAmount, $this->fixCurrency);
    }
    /**
     * @param Money $fix
     * @return $this
     */
    public function setFix(Money $fix)
    {
        $this->fixAmount = $fix->getAmount();
        $this->fixCurrency = $fix->getCurrency();
        return $this;
    }

}
