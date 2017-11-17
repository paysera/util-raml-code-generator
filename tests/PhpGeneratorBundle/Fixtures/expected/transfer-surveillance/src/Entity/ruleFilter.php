<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class ruleFilter extends Entity
{
    /**
     * @return integer|null
     */
    public function getLimit()
    {
        return $this->get('limit');
    }

    /**
     * @param integer $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->set('limit', $limit);
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getOffset()
    {
        return $this->get('offset');
    }

    /**
     * @param integer $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->set('offset', $offset);
        return $this;
    }

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

    /**
     * @return string|null
     */
    public function getOrderDirection()
    {
        return $this->get('order_direction');
    }

    /**
     * @param string $orderDirection
     * @return $this
     */
    public function setOrderDirection($orderDirection)
    {
        $this->set('order_direction', $orderDirection);
        return $this;
    }

}
