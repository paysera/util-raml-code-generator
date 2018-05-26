<?php

namespace Paysera\Test\TransferClient\Entity;

use Evp\Component\Money\Money;
use Paysera\Component\RestClientCommon\Entity\Entity;

class OutCommissionRule extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string|null
     */
    public function getPercent()
    {
        return $this->get('percent');
    }
    /**
     * @param string $percent
     * @return $this
     */
    public function setPercent($percent)
    {
        $this->set('percent', $percent);
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getMin()
    {
        if ($this->get('min_amount') === null && $this->get('min_currency') === null) {
            return null;
        }
        return new Money($this->get('min_amount'), $this->get('min_currency'));
    }
    /**
     * @param Money $min
     * @return $this
     */
    public function setMin(Money $min)
    {
        $this->set('min_amount', $min->getAmount());
        $this->set('min_currency', $min->getCurrency());
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getMax()
    {
        if ($this->get('max_amount') === null && $this->get('max_currency') === null) {
            return null;
        }
        return new Money($this->get('max_amount'), $this->get('max_currency'));
    }
    /**
     * @param Money $max
     * @return $this
     */
    public function setMax(Money $max)
    {
        $this->set('max_amount', $max->getAmount());
        $this->set('max_currency', $max->getCurrency());
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getFix()
    {
        if ($this->get('fix_amount') === null && $this->get('fix_currency') === null) {
            return null;
        }
        return new Money($this->get('fix_amount'), $this->get('fix_currency'));
    }
    /**
     * @param Money $fix
     * @return $this
     */
    public function setFix(Money $fix)
    {
        $this->set('fix_amount', $fix->getAmount());
        $this->set('fix_currency', $fix->getCurrency());
        return $this;
    }
}
