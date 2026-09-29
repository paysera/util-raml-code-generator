<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimeTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;

class PropertyTypeResolver
{
    private const UNION_SEPARATOR = '|';
    private const NULLABLE_UNION_MEMBERS = 2;
    private const NULLABLE_SHORTHAND_SUFFIX = '?';
    private const NULL_TYPE_NAMES = ['nil', 'null'];

    public function resolveType(array $definition) : ?string
    {
        if (!isset($definition['type'])) {
            return null;
        }

        return $this->resolveNullableType($definition) ?? $definition['type'];
    }

    public function isNullable(array $definition) : bool
    {
        return $this->resolveNullableType($definition) !== null;
    }

    public function hasNullMember(array $definition) : bool
    {
        if (!isset($definition['type'])) {
            return false;
        }

        if (substr($definition['type'], -1) === self::NULLABLE_SHORTHAND_SUFFIX) {
            return true;
        }

        $members = array_map('trim', explode(self::UNION_SEPARATOR, $definition['type']));

        return count(array_filter($members, [$this, 'isNullTypeName'])) > 0;
    }

    public function isDateTime(array $definition) : bool
    {
        $type = $this->resolveType($definition);

        return (
            in_array($type, DateTimeTypeDefinition::$supportedTypes, true)
            || (
                $type === PropertyDefinition::TYPE_INTEGER
                && array_key_exists(DateTimeTypeDefinition::ANNOTATION_TIMESTAMP, $definition)
            )
        );
    }

    private function resolveNullableType(array $definition) : ?string
    {
        if (!isset($definition['type'])) {
            return null;
        }

        $unwrappedType = $this->unwrapNullableType($definition['type']);
        if ($unwrappedType === null || !$this->isExpressibleType($unwrappedType, $definition)) {
            return null;
        }

        return $unwrappedType;
    }

    private function unwrapNullableType(string $type) : ?string
    {
        if (substr($type, -1) === self::NULLABLE_SHORTHAND_SUFFIX) {
            return trim(substr($type, 0, -1));
        }

        if (strpos($type, self::UNION_SEPARATOR) === false) {
            return null;
        }

        $members = array_map(
            'trim',
            explode(self::UNION_SEPARATOR, $type, self::NULLABLE_UNION_MEMBERS + 1)
        );
        if (count($members) !== self::NULLABLE_UNION_MEMBERS) {
            return null;
        }

        $nilPositions = array_keys(array_filter($members, [$this, 'isNullTypeName']));
        if (count($nilPositions) !== 1) {
            return null;
        }

        return $members[$nilPositions[0] === 0 ? 1 : 0];
    }

    private function isNullTypeName(string $member) : bool
    {
        return in_array($member, self::NULL_TYPE_NAMES, true);
    }

    private function isExpressibleType(string $type, array $definition) : bool
    {
        if (
            $type === ''
            || $this->isNullTypeName($type)
            || strpos($type, self::UNION_SEPARATOR) !== false
            || substr($type, -1) === self::NULLABLE_SHORTHAND_SUFFIX
            || strpos($type, '[]') !== false
        ) {
            return false;
        }

        if ($type === PropertyDefinition::TYPE_ARRAY) {
            return in_array($definition['items']['type'] ?? null, PropertyDefinition::getScalarTypes(), true);
        }

        return true;
    }
}
