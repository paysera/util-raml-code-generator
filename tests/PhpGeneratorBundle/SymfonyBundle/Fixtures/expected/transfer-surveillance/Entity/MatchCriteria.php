<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Entity;

class MatchCriteria
{
    private $id;
    private $matcherIdentifier;
    private $query;
    private $description;
    private $parameters;

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
     * @return string|null
     */
    public function getMatcherIdentifier()
    {
        return $this->matcherIdentifier;
    }
    /**
     * @param string $matcherIdentifier
     * @return $this
     */
    public function setMatcherIdentifier($matcherIdentifier)
    {
        $this->matcherIdentifier = $matcherIdentifier;
        return $this;
    }
    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }
    /**
     * @param string $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /**
     * @return string
     */
    public function getParameters()
    {
        return $this->parameters;
    }
    /**
     * @param string $parameters
     * @return $this
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

}
