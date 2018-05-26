<?php

namespace Paysera\Test\TransferSurveillanceClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Matcher extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->get('identifier');
    }
    /**
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->set('identifier', $identifier);
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
}
