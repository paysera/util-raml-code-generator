<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class WebmoneyAccount
{
    private $id;
    private $purse;

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
    public function getPurse()
    {
        return $this->purse;
    }
    /**
     * @param string $purse
     * @return $this
     */
    public function setPurse($purse)
    {
        $this->purse = $purse;
        return $this;
    }

}
