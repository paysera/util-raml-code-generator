<?php

namespace Paysera\Test\NamedScalarClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class SearchResultMetadata extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->get('source');
    }
    /**
     * @param string $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->set('source', $source);
        return $this;
    }
    /**
     * @return integer|null
     */
    public function getMatched()
    {
        return $this->get('matched');
    }
    /**
     * @param integer $matched
     * @return $this
     */
    public function setMatched($matched)
    {
        $this->set('matched', $matched);
        return $this;
    }
}
