<?php

namespace Paysera\Test\TransferClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TaxAccount extends Entity
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
}
