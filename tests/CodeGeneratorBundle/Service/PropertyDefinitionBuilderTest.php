<?php
declare(strict_types=1);

namespace Tests\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimePropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Exception\InvalidDefinitionException;
use Paysera\Bundle\CodeGeneratorBundle\Service\ConstantBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\PropertyDefinitionBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\PropertyTypeResolver;
use PHPUnit\Framework\TestCase;

class PropertyDefinitionBuilderTest extends TestCase
{
    /**
     * @var PropertyDefinitionBuilder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new PropertyDefinitionBuilder(new ConstantBuilder(), new PropertyTypeResolver());
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
        $this->assertSame($declaredType, $property->getDeclaredType());
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
                'Owner | nil',
                PropertyDefinition::TYPE_REFERENCE,
                'Owner',
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
            'a trailing separator is not a nullable union' => [
                'string |',
                PropertyDefinition::TYPE_REFERENCE,
                'string |',
                false,
            ],
            'a leading separator is not a nullable union' => [
                '| string',
                PropertyDefinition::TYPE_REFERENCE,
                '| string',
                false,
            ],
            'a falsy member is not a nil declaration' => [
                'string | 0',
                PropertyDefinition::TYPE_REFERENCE,
                'string | 0',
                false,
            ],
            'a falsy member is not a nil declaration in either position' => [
                '0 | string',
                PropertyDefinition::TYPE_REFERENCE,
                '0 | string',
                false,
            ],
            'bare nil is not a union' => [
                'nil',
                PropertyDefinition::TYPE_REFERENCE,
                'nil',
                false,
            ],
            'null is the same concept as nil' => [
                'boolean | null',
                PropertyDefinition::TYPE_BOOLEAN,
                null,
                true,
            ],
            'null before the declared type' => [
                'null | Owner',
                PropertyDefinition::TYPE_REFERENCE,
                'Owner',
                true,
            ],
            'nil unioned with null declares no type to fall back to' => [
                'nil | null',
                PropertyDefinition::TYPE_REFERENCE,
                'nil | null',
                false,
            ],
            'shorthand suffix marks a scalar nullable' => [
                'boolean?',
                PropertyDefinition::TYPE_BOOLEAN,
                null,
                true,
            ],
            'shorthand suffix marks a reference nullable' => [
                'Owner?',
                PropertyDefinition::TYPE_REFERENCE,
                'Owner',
                true,
            ],
            'a bare shorthand suffix declares no type' => [
                '?',
                PropertyDefinition::TYPE_REFERENCE,
                '?',
                false,
            ],
            'shorthand suffix on nil declares no type to fall back to' => [
                'nil?',
                PropertyDefinition::TYPE_REFERENCE,
                'nil?',
                false,
            ],
            'shorthand suffix on a union is not unwrapped' => [
                'string | nil?',
                PropertyDefinition::TYPE_REFERENCE,
                'string | nil?',
                false,
            ],
            'a doubled shorthand suffix is not unwrapped' => [
                'Owner??',
                PropertyDefinition::TYPE_REFERENCE,
                'Owner??',
                false,
            ],
            'an array without items is left intact rather than unwrapped' => [
                'array | nil',
                PropertyDefinition::TYPE_REFERENCE,
                'array | nil',
                false,
            ],
            'an array shorthand is not unwrapped' => [
                'string[] | nil',
                PropertyDefinition::TYPE_ARRAY,
                null,
                false,
            ],
            'an undefined type unwraps and is left for the validator to reject' => [
                'Unknown | nil',
                PropertyDefinition::TYPE_REFERENCE,
                'Unknown',
                true,
            ],
        ];
    }

    /**
     * @dataProvider dataProviderTestArrayItemsType
     */
    public function testArrayItemsType(string $declaredType, array $items, bool $expectedNullable)
    {
        $property = $this->builder->buildPropertyDefinition(
            'tags',
            ['type' => $declaredType, 'items' => $items, 'required' => true]
        );

        $this->assertInstanceOf(ArrayPropertyDefinition::class, $property);
        $this->assertSame('string', $property->getItemsType());
        $this->assertSame($expectedNullable, $property->isNullable());
    }

    public function dataProviderTestArrayItemsType()
    {
        return [
            'items declared as a type map' => ['array', ['type' => 'string'], false],
            'nullable array with items declared as a type map' => ['array | nil', ['type' => 'string'], true],
        ];
    }

    public function testNullableArrayOfReferencesIsLeftForTheValidatorToReject()
    {
        $property = $this->builder->buildPropertyDefinition(
            'owners',
            ['type' => 'array | nil', 'items' => ['type' => 'Owner'], 'required' => true]
        );

        $this->assertSame(PropertyDefinition::TYPE_REFERENCE, $property->getType());
        $this->assertSame('array | nil', $property->getReference());
        $this->assertFalse($property->isNullable());
    }

    public function testNullMemberOfNullableEnumIsNotAConstant()
    {
        $property = $this->builder->buildPropertyDefinition(
            'state',
            ['type' => 'string | nil', 'enum' => ['active', null], 'required' => true]
        );

        $this->assertCount(1, $property->getConstants());
        $this->assertSame('active', $property->getConstants()[0]->getValue());
    }

    public function testNullMemberOfUnsupportedNullableUnionIsLeftForTheValidatorToReject()
    {
        $property = $this->builder->buildPropertyDefinition(
            'state',
            ['type' => 'string | integer | nil', 'enum' => ['active', null], 'required' => true]
        );

        $this->assertSame(PropertyDefinition::TYPE_REFERENCE, $property->getType());
        $this->assertSame('string | integer | nil', $property->getReference());
        $this->assertCount(1, $property->getConstants());
    }

    public function testNullMemberOfNonNullableEnumIsRejected()
    {
        $this->expectException(InvalidDefinitionException::class);
        $this->expectExceptionMessage('Enum of property "state" lists null, but its type "string" is not nullable');

        $this->builder->buildPropertyDefinition(
            'state',
            ['type' => 'string', 'enum' => ['active', null], 'required' => true]
        );
    }

    /**
     * @dataProvider dataProviderTestNullableDateTimeKeepsItsOwnDefinitionType
     */
    public function testNullableDateTimeKeepsItsOwnDefinitionType(array $definition, string $expectedType)
    {
        $property = $this->builder->buildPropertyDefinition('updated_at', $definition + ['required' => true]);

        $this->assertInstanceOf(DateTimePropertyDefinition::class, $property);
        $this->assertSame($expectedType, $property->getType());
        $this->assertTrue($property->isNullable());
    }

    public function dataProviderTestNullableDateTimeKeepsItsOwnDefinitionType()
    {
        return [
            'nullable datetime' => [['type' => 'datetime | nil'], PropertyDefinition::TYPE_REFERENCE],
            'nullable timestamp union' => [
                ['type' => 'integer | nil', '(datetime_timestamp)' => null],
                PropertyDefinition::TYPE_INTEGER,
            ],
            'nullable timestamp shorthand' => [
                ['type' => 'integer?', '(datetime_timestamp)' => null],
                PropertyDefinition::TYPE_INTEGER,
            ],
        ];
    }

    /**
     * @dataProvider dataProviderTestRequiredIsPresenceAndNullabilityIsSeparate
     */
    public function testRequiredIsPresenceAndNullabilityIsSeparate(
        string $declaredType,
        bool $required,
        bool $expectedNullable,
        bool $expectedCanBeNull
    ) {
        $property = $this->builder->buildPropertyDefinition(
            'value',
            ['type' => $declaredType, 'required' => $required]
        );

        $this->assertSame($required, $property->isRequired());
        $this->assertSame($expectedNullable, $property->isNullable());
        $this->assertSame($expectedCanBeNull, $property->canBeNull());
    }

    public function dataProviderTestRequiredIsPresenceAndNullabilityIsSeparate()
    {
        return [
            'present and not nullable' => ['boolean', true, false, false],
            'present but nullable' => ['boolean | nil', true, true, true],
            'absent and not nullable' => ['boolean', false, false, true],
            'absent and nullable' => ['boolean | nil', false, true, true],
        ];
    }
}
