<?php

namespace Paysera\Test\NullableTypesClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Reviewer extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->get('user_id');
    }
    /**
     * @param string $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->set('user_id', $userId);
        return $this;
    }
    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->get('display_name');
    }
    /**
     * @param string $displayName
     * @return $this
     */
    public function setDisplayName($displayName)
    {
        $this->set('display_name', $displayName);
        return $this;
    }
}
