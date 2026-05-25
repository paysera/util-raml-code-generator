<?php

namespace Paysera\Test\MoneyCollectionClient\Entity;

use Evp\Component\Money\Money;
use Paysera\Component\RestClientCommon\Entity\Entity;

class Balance extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return Money[]
     */
    public function getCurrencyBalances()
    {
        $items = $this->getByReference('currency_balances');
        if ($items === null) {
            return [];
        }

        $list = [];
        foreach($items as &$item) {
            $list[] = new Money($item['amount'], $item['currency']);
        }

        return $list;
    }
    /**
     * @param Money[] $currencyBalances
     * @return $this
     */
    public function setCurrencyBalances(array $currencyBalances)
    {
        $data = [];
        foreach($currencyBalances as $item) {
            $data[] = ['amount' => $item->getAmount(), 'currency' => $item->getCurrency()];
        }
        $this->setByReference('currency_balances', $data);
        return $this;
    }
}
