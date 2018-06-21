<?php

namespace Vendor\Test\AuthApiBundle\Entity;

class SystemTokenRequest
{
    private $id;
    private $scope;
    private $audience;

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
    public function getScope()
    {
        return $this->scope;
    }
    /**
     * @param string $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }
    /**
     * @return string
     */
    public function getAudience()
    {
        return $this->audience;
    }
    /**
     * @param string $audience
     * @return $this
     */
    public function setAudience($audience)
    {
        $this->audience = $audience;
        return $this;
    }

}
