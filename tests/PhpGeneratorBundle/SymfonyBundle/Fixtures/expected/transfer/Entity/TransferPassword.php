<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class TransferPassword
{
    private $id;
    private $password;

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
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

}
