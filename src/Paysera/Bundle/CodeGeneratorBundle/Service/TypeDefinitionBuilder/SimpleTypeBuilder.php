<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Service\PropertyDefinitionBuilder;

class SimpleTypeBuilder implements TypeDefinitionBuilderInterface
{
    private $propertyDefinitionBuilder;

    public function __construct(PropertyDefinitionBuilder $propertyDefinitionBuilder)
    {
        $this->propertyDefinitionBuilder = $propertyDefinitionBuilder;
    }

    public function supports(string $name, array $definition)
    {
        return isset($definition['properties']);
    }

    public function buildTypeDefinition(string $name, array $definition)
    {
        $type = new TypeDefinition();
        $type
            ->setName($name)
            ->setType(isset($definition['type']) ? $definition['type'] : null)
            ->setDisplayName(isset($definition['displayName']) ? $definition['displayName'] : null)
        ;

        foreach ($definition['properties'] as $propertyName => $propertyDefinition) {
            $property = $this->propertyDefinitionBuilder->buildPropertyDefinition($propertyName, $propertyDefinition);
            $type->addProperty($property);
        }

        return $type;
    }
}
