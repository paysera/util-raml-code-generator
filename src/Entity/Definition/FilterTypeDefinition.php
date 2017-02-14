<?php

namespace Paysera\Util\RamlCodeGenerator\Entity\Definition;

class FilterTypeDefinition extends TypeDefinition
{
    /**
     * @var bool
     */
    private $extendsBaseFilter;

    public function __construct()
    {
        parent::__construct();
        $this->extendsBaseFilter = false;
    }

    /**
     * @return bool
     */
    public function extendsBaseFilter()
    {
        return $this->extendsBaseFilter;
    }

    /**
     * @param bool $extendsBaseFilter
     *
     * @return $this
     */
    public function setExtendsBaseFilter($extendsBaseFilter)
    {
        $this->extendsBaseFilter = $extendsBaseFilter;
        return $this;
    }
}
