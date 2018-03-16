<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

class ArgumentDefinition
{
    const TYPE_DEFAULT = 'string';
    const NAMESPACE_PREFIX = 'Entities\\';

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
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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

    /**
     * @return string
     */
    public function getNamespacedType()
    {
        if ($this->type === self::TYPE_DEFAULT) {
            return self::TYPE_DEFAULT;
        }

        return self::NAMESPACE_PREFIX . $this->type;
    }
}
