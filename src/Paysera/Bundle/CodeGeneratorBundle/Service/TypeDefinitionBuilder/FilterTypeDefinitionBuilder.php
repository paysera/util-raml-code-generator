<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\FilterTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Service\PropertyDefinitionBuilder;

class FilterTypeDefinitionBuilder implements TypeDefinitionBuilderInterface
{
    const TYPE_FILTER = 'Filter';

    private $propertyDefinitionBuilder;

    public function __construct(PropertyDefinitionBuilder $propertyDefinitionBuilder)
    {
        $this->propertyDefinitionBuilder = $propertyDefinitionBuilder;
    }

    public function supports(string $name, array $definition)
    {
        return strpos($name, self::TYPE_FILTER) !== false;
    }

    public function buildTypeDefinition(string $name, array $definition)
    {
        $type = new FilterTypeDefinition();
        $type
            ->setName($name)
            ->setType(isset($definition['type']) ? $definition['type'] : null)
            ->setDisplayName(isset($definition['displayName']) ? $definition['displayName'] : null)
        ;

        $fields = null;

        if (isset($definition['properties'])) {
            $fields = $definition['properties'];
        } elseif (isset($definition['queryParameters'])) {
            $fields = $definition['queryParameters'];
        }

        if ($fields === null) {
            return null;
        }

        foreach ($fields as $propertyName => $propertyDefinition) {
            $property = $this->propertyDefinitionBuilder->buildPropertyDefinition($propertyName, $propertyDefinition);
            $type->addProperty($property);
        }

        if ($name === self::TYPE_FILTER) {
            $type->setBaseFilter(true);
        }

        return $type;
    }
}
