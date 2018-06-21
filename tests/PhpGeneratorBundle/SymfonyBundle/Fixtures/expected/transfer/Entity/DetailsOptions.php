<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class DetailsOptions
{
    private $id;
    private $preserve;

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
     * @return boolean|null
     */
    public function isPreserve()
    {
        return $this->preserve;
    }
    /**
     * @param boolean $preserve
     * @return $this
     */
    public function setPreserve($preserve)
    {
        $this->preserve = $preserve;
        return $this;
    }

}
