<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimePropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimeTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\FilePropertyDefinition;
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
        $definition = $this->resolveNullableUnions($definition);

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

        if (
            !in_array(
                $property->getType(),
                array_merge(
                    PropertyDefinition::getSimpleTypes(),
                    [PropertyDefinition::TYPE_FILE]
                ),
                true
            )
        ) {
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

    /**
     * `X | nil` states that a property is present but may hold no value. That is nullability, not a
     * choice between two shapes, and every generated getter already returns null when the key is
     * absent — so the union collapses to `X` with nothing lost.
     *
     * A union of two real types (`string | boolean`) is a different thing entirely: it has no single
     * representation to generate, so it is deliberately left alone to fail loudly.
     */
    private function resolveNullableUnions(array $definition): array
    {
        if (isset($definition['type']) && is_string($definition['type'])) {
            $definition['type'] = $this->resolveNullableUnion($definition['type']);
        }

        if (isset($definition['items']['type']) && is_string($definition['items']['type'])) {
            $definition['items']['type'] = $this->resolveNullableUnion($definition['items']['type']);
        }

        return $definition;
    }

    private function resolveNullableUnion(string $type): string
    {
        if (strpos($type, '|') === false) {
            return $type;
        }

        $members = array_map('trim', explode('|', $type));
        $valueTypes = array_values(array_filter($members, static function (string $member) {
            return !in_array(strtolower($member), ['nil', 'null'], true);
        }));

        if (count($valueTypes) !== 1 || count($valueTypes) === count($members)) {
            return $type;
        }

        return $valueTypes[0];
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
        } elseif ($definition['type'] === PropertyDefinition::TYPE_FILE) {
            $property = new FilePropertyDefinition();
        }

        return $property;
    }
}
