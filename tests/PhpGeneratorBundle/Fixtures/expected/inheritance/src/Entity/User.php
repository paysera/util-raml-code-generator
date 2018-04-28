<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class User extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->get('id');
    }
    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->set('id', $id);
        return $this;
    }
}
