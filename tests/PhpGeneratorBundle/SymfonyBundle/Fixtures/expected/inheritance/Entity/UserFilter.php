<?php

namespace Vendor\Test\InheritanceApiBundle\Entity;

use Paysera\Component\Serializer\Entity\Filter;

class UserFilter extends Filter
{
    private $userId;
    private $userType;

    /**
     * @return integer|null
     */
    public function getUserId()
    {
        return $this->userId;
    }
    /**
     * @param integer $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getUserType()
    {
        return $this->userType;
    }
    /**
     * @param string $userType
     * @return $this
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
        return $this;
    }
}
