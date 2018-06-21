<?php

namespace Vendor\Test\UserInfoApiBundle\Entity;

class UserInfo
{
    const TYPE_LEGAL = 'legal';
    const TYPE_NATURAL = 'natural';

    private $id;
    private $type;

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
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

}
