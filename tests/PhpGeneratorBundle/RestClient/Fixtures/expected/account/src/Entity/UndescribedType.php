<?php

namespace Paysera\Test\AccountClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class UndescribedType extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return integer
     */
    public function getAge()
    {
        return $this->get('age');
    }
    /**
     * @param integer $age
     * @return $this
     */
    public function setAge($age)
    {
        $this->set('age', $age);
        return $this;
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
}
