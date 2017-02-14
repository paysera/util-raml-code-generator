<?php

namespace Paysera\Util\RamlCodeGenerator\Entity\Definition;

class ResultTypeDefinition extends TypeDefinition
{
    /**
     * @var string
     */
    private $dataKey;

    /**
     * @var string
     */
    private $itemsType;

    /**
     * @return string
     */
    public function getDataKey()
    {
        return $this->dataKey;
    }

    /**
     * @param string $dataKey
     *
     * @return $this
     */
    public function setDataKey($dataKey)
    {
        $this->dataKey = $dataKey;
        return $this;
    }

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
