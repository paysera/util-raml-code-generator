<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

class TypeDefinition
{
    const TYPE_OBJECT = 'object';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $displayName;

    /**
     * @var PropertyDefinition[]
     */
    private $properties;

    public function __construct()
    {
        $this->properties = [];
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
     * @return PropertyDefinition[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param PropertyDefinition[] $properties
     *
     * @return $this
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
        return $this;
    }

    /**
     * @param PropertyDefinition $property
     *
     * @return $this
     */
    public function addProperty($property)
    {
        $this->properties[] = $property;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     *
     * @return $this
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }
}
