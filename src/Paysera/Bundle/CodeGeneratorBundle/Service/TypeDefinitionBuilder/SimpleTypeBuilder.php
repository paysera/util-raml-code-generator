<?php
declare(strict_types=1);

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

    public function supports(string $name, array $definition): bool
    {
        return isset($definition['properties']) || isset($definition['queryParameters']);
    }

    public function buildTypeDefinition(string $name, array $definition)
    {
        $type = new TypeDefinition();
        $type
            ->setName($name)
            ->setType(isset($definition['type']) ? $definition['type'] : null)
            ->setDisplayName(isset($definition['displayName']) ? $definition['displayName'] : null)
            ->setData($definition)
        ;

        if (isset($definition['discriminator'])) {
            $type->setDiscriminatorKey($definition['discriminator']);
        }
        if (isset($definition['discriminatorValue'])) {
            $type->setDiscriminatorValue($definition['discriminatorValue']);
        }

        $properties = [];
        if (isset($definition['properties'])) {
            $properties = $definition['properties'];
        } elseif ($definition['queryParameters']) {
            $properties = $definition['queryParameters'];
        }
        foreach ($properties as $propertyName => $propertyDefinition) {
            $property = $this->propertyDefinitionBuilder->buildPropertyDefinition($propertyName, $propertyDefinition);
            $type->addProperty($property);
        }

        return $type;
    }
}
