<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Entity;

use Paysera\Component\Serializer\Entity\Filter;

class RuleFilter extends Filter
{
    private $orderBy;

    /**
     * @return string|null
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }
    /**
     * @param string $orderBy
     * @return $this
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }
}
