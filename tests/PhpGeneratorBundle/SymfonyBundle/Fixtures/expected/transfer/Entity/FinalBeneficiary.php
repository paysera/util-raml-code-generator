<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class FinalBeneficiary
{
    const PERSON_TYPE_NATURAL = 'natural';
    const PERSON_TYPE_LEGAL = 'legal';

    private $id;
    private $name;
    private $identifiers;
    private $personType;

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
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return Identifiers|null
     */
    public function getIdentifiers()
    {
        return $this->identifiers;
    }
    /**
     * @param Identifiers $identifiers
     * @return $this
     */
    public function setIdentifiers(Identifiers $identifiers)
    {
        $this->identifiers = $identifiers;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPersonType()
    {
        return $this->personType;
    }
    /**
     * @param string $personType
     * @return $this
     */
    public function setPersonType($personType)
    {
        $this->personType = $personType;
        return $this;
    }

}
