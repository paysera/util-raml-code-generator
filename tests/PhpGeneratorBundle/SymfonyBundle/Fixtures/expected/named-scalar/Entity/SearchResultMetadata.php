<?php

namespace Vendor\Test\NamedScalarApiBundle\Entity;

class SearchResultMetadata
{
    private $id;
    private $source;
    private $matched;

    public function __construct()
    {
            
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }
    /**
     * @param string $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }
    /**
     * @return integer|null
     */
    public function getMatched()
    {
        return $this->matched;
    }
    /**
     * @param integer $matched
     * @return $this
     */
    public function setMatched($matched)
    {
        $this->matched = $matched;
        return $this;
    }

}
