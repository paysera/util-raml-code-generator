<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Entity;

class RiskRule
{
    private $id;
    private $name;
    private $applied;

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
     * @return boolean
     */
    public function isApplied()
    {
        return $this->applied;
    }
    /**
     * @param boolean $applied
     * @return $this
     */
    public function setApplied($applied)
    {
        $this->applied = $applied;
        return $this;
    }

}
