<?php

namespace Paysera\Test\NullableUnionClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class OrderLine extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->get('sku');
    }
    /**
     * @param string $sku
     * @return $this
     */
    public function setSku($sku)
    {
        $this->set('sku', $sku);
        return $this;
    }
    /**
     * @return integer
     */
    public function getQuantity()
    {
        return $this->get('quantity');
    }
    /**
     * @param integer $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->set('quantity', $quantity);
        return $this;
    }
}
