<?php

namespace Paysera\Test\UserInfoClient\Entity;

class Natural extends UserInfo
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->setType(self::TYPE_NATURAL);
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
