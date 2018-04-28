<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Filter;

class UserFilter extends Filter
{
    /**
     * @return integer|null
     */
    public function getUserId()
    {
        return $this->get('user_id');
    }
    /**
     * @param integer $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->set('user_id', $userId);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getUserType()
    {
        return $this->get('user_type');
    }
    /**
     * @param string $userType
     * @return $this
     */
    public function setUserType($userType)
    {
        $this->set('user_type', $userType);
        return $this;
    }
}
