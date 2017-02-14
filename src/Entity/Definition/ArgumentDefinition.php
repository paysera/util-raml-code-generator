<?php

namespace Paysera\Util\RamlCodeGenerator\Entity\Definition;

class ArgumentDefinition
{
    const TYPE_DEFAULT = 'string';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->type = self::TYPE_DEFAULT;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}
