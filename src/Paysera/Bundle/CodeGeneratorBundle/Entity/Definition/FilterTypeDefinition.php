<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

class FilterTypeDefinition extends TypeDefinition
{
    const BASE_FILTER = 'Filter';

    /**
     * @var bool
     */
    private $baseFilter;

    /**
     * @var bool
     */
    private $extendsBaseFilter;

    public function __construct()
    {
        parent::__construct();

        $this->baseFilter = false;
        $this->extendsBaseFilter = false;
    }

    /**
     * @return bool
     */
    public function isBaseFilter()
    {
        return $this->baseFilter;
    }

    /**
     * @param bool $baseFilter
     *
     * @return $this
     */
    public function setBaseFilter(bool $baseFilter)
    {
        $this->baseFilter = $baseFilter;
        return $this;
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
    public function setExtendsBaseFilter(bool $extendsBaseFilter)
    {
        $this->extendsBaseFilter = $extendsBaseFilter;
        return $this;
    }
}
