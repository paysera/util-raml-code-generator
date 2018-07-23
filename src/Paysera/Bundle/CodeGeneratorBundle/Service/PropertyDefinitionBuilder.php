<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimePropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimeTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;

class PropertyDefinitionBuilder
{
    private $constantBuilder;

    public function __construct(ConstantBuilder $constantBuilder)
    {
        $this->constantBuilder = $constantBuilder;
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
            $reference = null;
            if (isset($definition['type'])) {
                $reference = $definition['type'];
            }
            $property
                ->setType(PropertyDefinition::TYPE_REFERENCE)
                ->setReference($reference)
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
            && in_array($definition['type'], DateTimeTypeDefinition::$supportedTypes, true)
            || (
                isset($definition['type']) && $definition['type'] === PropertyDefinition::TYPE_INTEGER
                && array_key_exists(DateTimeTypeDefinition::ANNOTATION_TIMESTAMP, $definition)
            )
        ) {
            $property = new DateTimePropertyDefinition();
            if (isset($definition['format'])) {
                $property->setFormat($definition['format']);
            }
        }

        return $property;
    }
}
