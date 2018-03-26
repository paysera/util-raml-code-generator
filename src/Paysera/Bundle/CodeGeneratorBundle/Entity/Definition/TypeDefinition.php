<?php
declare(strict_types=1);

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

    /**
     * @var bool
     */
    private $generatable;

    public function __construct()
    {
        $this->properties = [];
        $this->generatable = true;
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
    public function setName(string $name)
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
    public function getProperties(): array
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
    public function addProperty(PropertyDefinition $property)
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

    public function isGeneratable(): bool
    {
        return $this->generatable;
    }

    /**
     * @param bool $generatable
     *
     * @return $this
     */
    public function setGeneratable(bool $generatable)
    {
        $this->generatable = $generatable;

        return $this;
    }
}
