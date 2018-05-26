<?php

namespace Paysera\Test\InheritanceClient\Entity;

class UserBasic extends User
{
    const TYPE_LEGAL = 'legal';
    const TYPE_NATURAL = 'natural';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->get('type');
    }
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->set('type', $type);
        return $this;
    }
}
