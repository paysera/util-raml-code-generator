<?php

namespace Paysera\Test\TestClient\Entity;

class UserNatural extends User
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
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
     * @return string
     */
    public function getSurname()
    {
        return $this->get('surname');
    }
    /**
     * @param string $surname
     * @return $this
     */
    public function setSurname($surname)
    {
        $this->set('surname', $surname);
        return $this;
    }
}
