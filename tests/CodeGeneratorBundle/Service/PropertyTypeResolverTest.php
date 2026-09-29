<?php
declare(strict_types=1);

namespace Tests\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Service\PropertyTypeResolver;
use PHPUnit\Framework\TestCase;

class PropertyTypeResolverTest extends TestCase
{
    /**
     * @dataProvider dataProviderTestHasNullMember
     */
    public function testHasNullMember(array $definition, bool $expectedHasNullMember)
    {
        $this->assertSame($expectedHasNullMember, (new PropertyTypeResolver())->hasNullMember($definition));
    }

    public function dataProviderTestHasNullMember()
    {
        return [
            'scalar shorthand' => [['type' => 'string?'], true],
            'reference shorthand' => [['type' => 'Owner?'], true],
            'nil after the type' => [['type' => 'string | nil'], true],
            'nil before the type' => [['type' => 'nil | string'], true],
            'null alias' => [['type' => 'string | null'], true],
            'unsupported union naming nil' => [['type' => 'string | integer | nil'], true],
            'bare nil' => [['type' => 'nil'], true],
            'plain type' => [['type' => 'string'], false],
            'union without a null member' => [['type' => 'string | integer'], false],
            'falsy member' => [['type' => 'string | 0'], false],
            'no type' => [[], false],
        ];
    }

    /**
     * @dataProvider dataProviderTestDefinitionWithoutTypeResolvesToNothing
     */
    public function testDefinitionWithoutTypeResolvesToNothing(array $definition)
    {
        $resolver = new PropertyTypeResolver();

        $this->assertNull($resolver->resolveType($definition));
        $this->assertFalse($resolver->isNullable($definition));
        $this->assertFalse($resolver->isDateTime($definition));
    }

    public function dataProviderTestDefinitionWithoutTypeResolvesToNothing()
    {
        return [
            'empty definition' => [[]],
            'timestamp annotation without a type' => [['(datetime_timestamp)' => null]],
        ];
    }
}
