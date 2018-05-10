<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

class TypeDefinition
{
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

    /**
     * @var TypeDefinition|null
     */
    private $parent;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $discriminatorKey;

    /**
     * @var string
     */
    private $discriminatorValue;

    public function __construct()
    {
        $this->properties = [];
        $this->data = [];
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
     * @param string|null $type
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
     * @param string|null $displayName
     *
     * @return $this
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @return null|TypeDefinition
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param null|TypeDefinition $parent
     *
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscriminatorKey()
    {
        return $this->discriminatorKey;
    }

    /**
     * @param string $discriminatorKey
     *
     * @return $this
     */
    public function setDiscriminatorKey($discriminatorKey)
    {
        $this->discriminatorKey = $discriminatorKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscriminatorValue()
    {
        return $this->discriminatorValue;
    }

    /**
     * @param string $discriminatorValue
     *
     * @return $this
     */
    public function setDiscriminatorValue($discriminatorValue)
    {
        $this->discriminatorValue = $discriminatorValue;
        return $this;
    }
}
