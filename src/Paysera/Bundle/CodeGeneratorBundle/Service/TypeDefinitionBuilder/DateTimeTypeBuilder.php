<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimeTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;

class DateTimeTypeBuilder implements TypeDefinitionBuilderInterface
{
    public function supports(string $name, array $definition): bool
    {
        $fields = [];
        if (isset($definition['properties'])) {
            $fields = $definition['properties'];
        } elseif (isset($definition['queryParameters'])) {
            $fields = $definition['queryParameters'];
        }
        foreach ($fields as $field) {
            if (
                (
                    isset($field['type'])
                    && in_array($field['type'], DateTimeTypeDefinition::$supportedTypes, true)
                )
                ||
                (
                    $field['type'] === PropertyDefinition::TYPE_INTEGER
                    && array_key_exists(DateTimeTypeDefinition::ANNOTATION_TIMESTAMP, $field)
                )
            ) {
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
