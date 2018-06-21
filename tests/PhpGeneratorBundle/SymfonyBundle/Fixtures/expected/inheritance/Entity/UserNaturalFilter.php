<?php

namespace Vendor\Test\InheritanceApiBundle\Entity;

class UserNaturalFilter
{
    private $firstName;
    private $lastName;

    /**
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
}
