<?php

namespace Vendor\Test\AccountApiBundle\Entity;

class UndescribedType
{
    private $id;
    private $age;
    private $name;

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
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }
    /**
     * @param integer $age
     * @return $this
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }
    /**
     * @return string
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

}
