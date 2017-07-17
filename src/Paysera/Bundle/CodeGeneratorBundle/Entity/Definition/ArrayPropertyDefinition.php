<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

class ArrayPropertyDefinition extends PropertyDefinition
{
    /**
     * @var string
     */
    private $itemsType;

    /**
     * @return string
     */
    public function getItemsType()
    {
        return $this->itemsType;
    }

    /**
     * @param string $itemsType
     *
     * @return $this
     */
    public function setItemsType($itemsType)
    {
        $this->itemsType = $itemsType;
        return $this;
    }
}
