<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimeTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Service\PropertyTypeResolver;

class DateTimeTypeBuilder implements TypeDefinitionBuilderInterface
{
    private $propertyTypeResolver;

    public function __construct(PropertyTypeResolver $propertyTypeResolver)
    {
        $this->propertyTypeResolver = $propertyTypeResolver;
    }

    public function supports(string $name, array $definition): bool
    {
        $fields = [];
        if (isset($definition['properties'])) {
            $fields = $definition['properties'];
        } elseif (isset($definition['queryParameters'])) {
            $fields = $definition['queryParameters'];
        }
        foreach ($fields as $field) {
            if (is_array($field) && $this->propertyTypeResolver->isDateTime($field)) {
                return true;
            }
        }

        return false;
    }

    public function buildTypeDefinition(string $name, array $definition)
    {
        return (new DateTimeTypeDefinition())
            ->setName(DateTimeTypeDefinition::NAME)
        ;
    }
}
