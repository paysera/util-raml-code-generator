<?php
declare(strict_types=1);

namespace Tests\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimePropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Service\ConstantBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\PropertyDefinitionBuilder;
use PHPUnit\Framework\TestCase;

class PropertyDefinitionBuilderTest extends TestCase
{
    /**
     * @var PropertyDefinitionBuilder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new PropertyDefinitionBuilder(new ConstantBuilder());
    }

    /**
     * @dataProvider dataProviderTestNullableDeclaration
     */
    public function testNullableDeclaration(
        string $declaredType,
        string $expectedType,
        ?string $expectedReference,
        bool $expectedNullable
    ) {
        $property = $this->builder->buildPropertyDefinition(
            'value',
            ['type' => $declaredType, 'required' => true]
        );

        $this->assertSame($expectedType, $property->getType());
        $this->assertSame($expectedReference, $property->getReference());
        $this->assertSame($expectedNullable, $property->isNullable());
    }

    public function dataProviderTestNullableDeclaration()
    {
        return [
            'plain scalar carries no nullability' => [
                'boolean',
                PropertyDefinition::TYPE_BOOLEAN,
                null,
                false,
            ],
            'scalar before nil' => [
                'boolean | nil',
                PropertyDefinition::TYPE_BOOLEAN,
                null,
                true,
            ],
            'scalar after nil' => [
                'nil | boolean',
                PropertyDefinition::TYPE_BOOLEAN,
                null,
                true,
            ],
            'no surrounding whitespace' => [
                'boolean|nil',
                PropertyDefinition::TYPE_BOOLEAN,
                null,
                true,
            ],
            'padded whitespace' => [
                'boolean   |   nil',
                PropertyDefinition::TYPE_BOOLEAN,
                null,
                true,
            ],
            'named type resolves to the bare reference' => [
                'Reviewer | nil',
                PropertyDefinition::TYPE_REFERENCE,
                'Reviewer',
                true,
            ],
            'two genuine types are left intact for the validator to reject' => [
                'string | integer',
                PropertyDefinition::TYPE_REFERENCE,
                'string | integer',
                false,
            ],
            'three members are left intact even when one is nil' => [
                'string | integer | nil',
                PropertyDefinition::TYPE_REFERENCE,
                'string | integer | nil',
                false,
            ],
            'nil unioned with itself declares no type to fall back to' => [
                'nil | nil',
                PropertyDefinition::TYPE_REFERENCE,
                'nil | nil',
                false,
            ],
            'a missing member declares no type to fall back to' => [
                ' | nil',
                PropertyDefinition::TYPE_REFERENCE,
                ' | nil',
                false,
            ],
            'bare nil is not a union' => [
                'nil',
                PropertyDefinition::TYPE_REFERENCE,
                'nil',
                false,
            ],
        ];
    }

    public function testNullableDateTimeKeepsItsOwnDefinitionType()
    {
        $property = $this->builder->buildPropertyDefinition(
            'reviewed_at',
            ['type' => 'datetime | nil', 'required' => true]
        );

        $this->assertInstanceOf(DateTimePropertyDefinition::class, $property);
        $this->assertTrue($property->isNullable());
    }

    /**
     * @dataProvider dataProviderTestAllowsNullValue
     */
    public function testAllowsNullValue(string $declaredType, bool $required, bool $expected)
    {
        $property = $this->builder->buildPropertyDefinition(
            'value',
            ['type' => $declaredType, 'required' => $required]
        );

        $this->assertSame($expected, $property->allowsNullValue());
    }

    public function dataProviderTestAllowsNullValue()
    {
        return [
            'required and not nullable' => ['boolean', true, false],
            'required and nullable' => ['boolean | nil', true, true],
            'optional and not nullable' => ['boolean', false, true],
            'optional and nullable' => ['boolean | nil', false, true],
        ];
    }
}
