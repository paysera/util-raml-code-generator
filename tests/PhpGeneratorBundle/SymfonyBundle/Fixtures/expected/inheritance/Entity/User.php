<?php

namespace Vendor\Test\InheritanceApiBundle\Entity;

class User
{
    private $id;

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

}
