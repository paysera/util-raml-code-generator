<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\FilterTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Service\PropertyDefinitionBuilder;

class FilterTypeDefinitionBuilder implements TypeDefinitionBuilderInterface
{
    private $propertyDefinitionBuilder;

    public function __construct(PropertyDefinitionBuilder $propertyDefinitionBuilder)
    {
        $this->propertyDefinitionBuilder = $propertyDefinitionBuilder;
    }

    public function supports(string $name, array $definition): bool
    {
        return strpos($name, FilterTypeDefinition::BASE_FILTER) !== false;
    }

    public function buildTypeDefinition(string $name, array $definition)
    {
        $type = new FilterTypeDefinition();
        $type
            ->setName($name)
            ->setType(isset($definition['type']) ? $definition['type'] : null)
            ->setDisplayName(isset($definition['displayName']) ? $definition['displayName'] : null)
            ->setData($definition)
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

        if ($name === FilterTypeDefinition::BASE_FILTER) {
            $type->setBaseFilter(true);
        }

        return $type;
    }
}
