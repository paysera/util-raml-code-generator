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
    private const RAML_TYPE_NIL = 'nil';
    private const UNION_SEPARATOR = '|';

    private $constantBuilder;

    public function __construct(ConstantBuilder $constantBuilder)
    {
        $this->constantBuilder = $constantBuilder;
    }

    public function buildPropertyDefinition(string $name, array $definition)
    {
        $nullable = false;
        if (isset($definition['type'])) {
            $unwrappedType = $this->unwrapNullableType($definition['type']);
            if ($unwrappedType !== null) {
                $definition['type'] = $unwrappedType;
                $nullable = true;
            }
        }

        $property = $this->getPropertyDefinition($definition);

        $property
            ->setName($name)
            ->setType(isset($definition['type']) ? $definition['type'] : null)
            ->setDescription(isset($definition['description']) ? $definition['description'] : null)
            ->setRequired(isset($definition['required']) ? $definition['required'] : false)
            ->setNullable($nullable)
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

    private function unwrapNullableType(string $type)
    {
        if (strpos($type, self::UNION_SEPARATOR) === false) {
            return null;
        }

        $members = array_map('trim', explode(self::UNION_SEPARATOR, $type));
        if (count($members) !== 2) {
            return null;
        }

        $nilPosition = array_search(self::RAML_TYPE_NIL, $members, true);
        if ($nilPosition === false) {
            return null;
        }

        $declaredType = $members[$nilPosition === 0 ? 1 : 0];

        return $declaredType === self::RAML_TYPE_NIL || $declaredType === '' ? null : $declaredType;
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
