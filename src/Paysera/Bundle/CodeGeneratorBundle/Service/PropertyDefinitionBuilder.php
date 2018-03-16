<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimePropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;

class PropertyDefinitionBuilder
{
    /**
     * @var array
     */
    private $supportedDateTimeTypes;
    private $constantBuilder;

    public function __construct(ConstantBuilder $constantBuilder)
    {
        $this->constantBuilder = $constantBuilder;
        $this->supportedDateTimeTypes = [
            'datetime',
            'datetime-only',
            'date-only',
            'time-only',
        ];
    }

    public function buildPropertyDefinition(string $name, array $definition)
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

        if (isset($definition['enum'])) {
            $property->setConstants($this->constantBuilder->build($name, $definition['enum']));
        }

        return $property;
    }

    private function getPropertyDefinition(array $definition)
    {
        $property = new PropertyDefinition();

        if (isset($definition['type']) && $definition['type'] === PropertyDefinition::TYPE_ARRAY) {
            $property = new ArrayPropertyDefinition();
            $property
                ->setItemsType($definition['items']['type'])
            ;
        } elseif (
            isset($definition['type'])
            && in_array($definition['type'], $this->supportedDateTimeTypes, true)
            || (
                isset($definition['type']) && $definition['type'] === PropertyDefinition::TYPE_INTEGER
                && array_key_exists(DateTimePropertyDefinition::ANNOTATION_TIMESTAMP, $definition)
            )
        ) {
            $property = new DateTimePropertyDefinition();
        }

        return $property;
    }
}
