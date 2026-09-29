<?php
declare(strict_types=1);

namespace Tests\CodeGeneratorBundle\Service\TypeDefinitionBuilder;

use Paysera\Bundle\CodeGeneratorBundle\Service\PropertyTypeResolver;
use Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder\DateTimeTypeBuilder;
use PHPUnit\Framework\TestCase;

class DateTimeTypeBuilderTest extends TestCase
{
    /**
     * @dataProvider dataProviderTestSupports
     * @param array|string $field
     */
    public function testSupports($field, bool $expectedSupported)
    {
        $builder = new DateTimeTypeBuilder(new PropertyTypeResolver());

        $this->assertSame($expectedSupported, $builder->supports('Item', ['properties' => ['value' => $field]]));
    }

    public function dataProviderTestSupports()
    {
        return [
            'datetime' => [['type' => 'datetime'], true],
            'nullable datetime union' => [['type' => 'datetime | nil'], true],
            'nullable datetime shorthand' => [['type' => 'datetime?'], true],
            'timestamp' => [['type' => 'integer', '(datetime_timestamp)' => null], true],
            'nullable timestamp' => [['type' => 'integer | nil', '(datetime_timestamp)' => null], true],
            'nullable integer without timestamp annotation' => [['type' => 'integer | nil'], false],
            'nullable string' => [['type' => 'string | nil'], false],
            'property declared with the shorthand form' => ['integer', false],
        ];
    }
}
