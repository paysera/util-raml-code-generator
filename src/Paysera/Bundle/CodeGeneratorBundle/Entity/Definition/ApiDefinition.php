<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Entity\Definition;

use Raml\ApiDefinition as RamlApiDefinition;

class ApiDefinition
{
    /**
     * @var TypeDefinition[]
     */
    private $types;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $namespace;

    private $ramlDefinition;

    public function __construct(RamlApiDefinition $ramlDefinition)
    {
        $this->ramlDefinition = $ramlDefinition;
        $this->types = [];
    }

    /**
     * @return TypeDefinition[]
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param TypeDefinition[] $types
     *
     * @return $this
     */
    public function setTypes($types)
    {
        $this->types = $types;
        return $this;
    }

    /**
     * @param string $name
     * @return null|TypeDefinition
     */
    public function getType($name)
    {
        foreach ($this->types as $type) {
            if ($type->getName() === $name) {
                return $type;
            }
        }

        return null;
    }

    /**
     * @return RamlApiDefinition
     */
    public function getRamlDefinition()
    {
        return $this->ramlDefinition;
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
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     *
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }
}
