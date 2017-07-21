<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimePropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;

class PropertyDefinitionBuilder
{
    private $supportedDateTimeTypes = [
        'datetime',
        'datetime-only',
        'date-only',
        'time-only',
    ];

    /**
     * @param string $name
     * @param array $definition
     * @return PropertyDefinition
     */
    public function buildPropertyDefinition($name, array $definition)
    {
        $property = $this->getPropertyDefinition($definition);

        $property
            ->setName($name)
            ->setType(isset($definition['type']) ? $definition['type'] : null)
            ->setDescription(isset($definition['description']) ? $definition['description'] : null)
            ->setRequired(isset($definition['required']) ? $definition['required'] : false)
        ;

        if (isset($definition['type']) && strpos($definition['type'], '[]') !== false) {
            $property->setType(PropertyDefinition::TYPE_ARRAY);
        }

        if (!in_array($property->getType(), PropertyDefinition::getSimpleTypes(), true)) {
            $property
                ->setType(PropertyDefinition::TYPE_REFERENCE)
                ->setReference(isset($definition['type']) ? $definition['type'] : null)
            ;
        }

        return $property;
    }

    /**
     * @param array $definition
     * @return PropertyDefinition
     */
    private function getPropertyDefinition(array $definition)
    {
        $property = new PropertyDefinition();

        if (isset($definition['type']) && $definition['type'] === PropertyDefinition::TYPE_ARRAY) {
            $property = new ArrayPropertyDefinition();
            $property
                ->setItemsType($definition['items']['type'])
            ;
        } elseif (
            in_array($definition['type'], $this->supportedDateTimeTypes, true)
            || (
                $definition['type'] === PropertyDefinition::TYPE_INTEGER
                && array_key_exists(DateTimePropertyDefinition::ANNOTATION_TIMESTAMP, $definition)
            )
        ) {
            $property = new DateTimePropertyDefinition();
        }

        return $property;
    }
}
