<?php

namespace Paysera\Test\TransferSurveillanceClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Filter;

class RuleFilter extends Filter
{
    /**
     * @return string|null
     */
    public function getOrderBy()
    {
        return $this->get('order_by');
    }
    /**
     * @param string $orderBy
     * @return $this
     */
    public function setOrderBy($orderBy)
    {
        $this->set('order_by', $orderBy);
        return $this;
    }
}
