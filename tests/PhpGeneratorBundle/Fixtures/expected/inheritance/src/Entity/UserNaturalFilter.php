<?php

namespace Paysera\Test\InheritanceClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class UserNaturalFilter extends Entity
{
    /**
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->get('first_name');
    }
    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->set('first_name', $firstName);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getLastName()
    {
        return $this->get('last_name');
    }
    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->set('last_name', $lastName);
        return $this;
    }
}
