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
        if (!isset($this->get('min')['amount']) || !isset($this->get('min')['currency'])) {
            return null;
        }
        return new Money($this->get('min')['amount'], $this->get('min')['currency']);
    }
    /**
     * @param Money $min
     * @return $this
     */
    public function setMin(Money $min)
    {
        $this->set('min', ['amount' => $min->getAmount(), 'currency' => $min->getCurrency()]);
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getMax()
    {
        if (!isset($this->get('max')['amount']) || !isset($this->get('max')['currency'])) {
            return null;
        }
        return new Money($this->get('max')['amount'], $this->get('max')['currency']);
    }
    /**
     * @param Money $max
     * @return $this
     */
    public function setMax(Money $max)
    {
        $this->set('max', ['amount' => $max->getAmount(), 'currency' => $max->getCurrency()]);
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getFix()
    {
        if (!isset($this->get('fix')['amount']) || !isset($this->get('fix')['currency'])) {
            return null;
        }
        return new Money($this->get('fix')['amount'], $this->get('fix')['currency']);
    }
    /**
     * @param Money $fix
     * @return $this
     */
    public function setFix(Money $fix)
    {
        $this->set('fix', ['amount' => $fix->getAmount(), 'currency' => $fix->getCurrency()]);
        return $this;
    }
}
