<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class FinalBeneficiary extends Entity
{
    const PERSON_TYPE_NATURAL = 'natural';
    const PERSON_TYPE_LEGAL = 'legal';

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->get('name');
    }
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->set('name', $name);
        return $this;
    }
    /**
     * @return Identifiers|null
     */
    public function getIdentifiers()
    {
        return (new Identifiers())->setDataByReference($this->getByReference('identifiers'));
    }
    /**
     * @param Identifiers $identifiers
     * @return $this
     */
    public function setIdentifiers(Identifiers $identifiers)
    {
        $this->setByReference('identifiers', $identifiers->getDataByReference());
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPersonType()
    {
        return $this->get('person_type');
    }
    /**
     * @param string $personType
     * @return $this
     */
    public function setPersonType($personType)
    {
        $this->set('person_type', $personType);
        return $this;
    }
}
