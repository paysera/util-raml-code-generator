<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Entity;

class ManualRule
{
    private $id;
    private $name;
    private $userId;

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
    /**
     * @return string|null
     */
    public function getUserId()
    {
        return $this->userId;
    }
    /**
     * @param string $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

}
