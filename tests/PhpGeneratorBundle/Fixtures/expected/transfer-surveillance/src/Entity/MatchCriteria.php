<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class MatchCriteria extends Entity
{
    /**
     * @return integer|null
     */
    public function getId()
    {
        return $this->get('id');
    }
    /**
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->set('id', $id);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getMatcherIdentifier()
    {
        return $this->get('matcher_identifier');
    }
    /**
     * @param string $matcherIdentifier
     * @return $this
     */
    public function setMatcherIdentifier($matcherIdentifier)
    {
        $this->set('matcher_identifier', $matcherIdentifier);
        return $this;
    }
    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->get('query');
    }
    /**
     * @param string $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->set('query', $query);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->get('description');
    }
    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->set('description', $description);
        return $this;
    }
    /**
     * @return string
     */
    public function getParameters()
    {
        return $this->get('parameters');
    }
    /**
     * @param string $parameters
     * @return $this
     */
    public function setParameters($parameters)
    {
        $this->set('parameters', $parameters);
        return $this;
    }
}
