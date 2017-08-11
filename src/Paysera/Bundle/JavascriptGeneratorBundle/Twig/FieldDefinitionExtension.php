<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Twig;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimePropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;
use Paysera\Bundle\PhpGeneratorBundle\Service\StringConverter;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class FieldDefinitionExtension extends Twig_Extension
{
    const DATETIME_INSTANCE = 'Date';

    private $stringConverter;

    public function __construct(StringConverter $stringConverter)
    {
        $this->stringConverter = $stringConverter;
    }

    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('to_variable_name', [$this->stringConverter, 'convertSlugToVariableName']),
            new Twig_SimpleFilter('to_class_name', [$this->stringConverter, 'convertSlugToClassName']),
        ];
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('js_generate_getter_name', [$this, 'getGetterName']),
            new Twig_SimpleFunction('js_generate_setter_name', [$this, 'getSetterName']),
            new Twig_SimpleFunction('js_generate_value_extractor', [$this, 'generateValueExtractor'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('js_generate_value_populator', [$this, 'generateValuePopulator'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('js_get_doc_block', [$this, 'getDocBlock']),
        ];
    }

    public function getGetterName(PropertyDefinition $definition) : string
    {
        $name = ucfirst($this->stringConverter->convertSlugToVariableName($definition->getName()));

        if ($definition->getType() === PropertyDefinition::TYPE_BOOLEAN) {
            return 'is' . $name;
        }

        return 'get' . $name;
    }

    public function getSetterName(PropertyDefinition $definition) : string
    {
        return 'set' . ucfirst($this->stringConverter->convertSlugToVariableName($definition->getName()));
    }

    public function getDocBlock(PropertyDefinition $definition, bool $isGetter) : string
    {
        $typehint = $definition->getType();

        if ($definition->getType() === PropertyDefinition::TYPE_REFERENCE) {
            $typehint = sprintf('{%s}', $definition->getReference());
        } elseif ($definition instanceof ArrayPropertyDefinition) {
            $typehint = sprintf('{Array.<%s>}', $definition->getItemsType());
        } elseif ($definition instanceof DateTimePropertyDefinition) {
            $typehint = sprintf('{%s}', self::DATETIME_INSTANCE);
        } elseif ($definition->getType() === PropertyDefinition::TYPE_INTEGER) {
            $typehint = '{Number}';
        } else {
            $typehint = sprintf('{%s}', $typehint);
        }

        if ($isGetter) {
            if (!$definition->isRequired()) {
                $typehint .= '|null';
            }
            return $typehint;
        }

        return sprintf('%s %s', $typehint, $this->stringConverter->convertSlugToVariableName($definition->getName()));
    }

    public function generateValueExtractor(PropertyDefinition $definition) : string
    {
        $extractor = $this->stringConverter->convertSlugToVariableName($definition->getName());

        if ($definition instanceof DateTimePropertyDefinition) {
            $extractor .= '.getTime()';
            return sprintf('this.set(\'%s\', %s)', $definition->getName(), $extractor);
        } elseif ($definition->getType() === PropertyDefinition::TYPE_REFERENCE) {
            $extractor .= '.data';
            return sprintf('this.set(\'%s\', %s)', $definition->getName(), $extractor);
        } else {
            return sprintf('this.set(\'%s\', %s)', $definition->getName(), $extractor);
        }
    }

    public function generateValuePopulator(PropertyDefinition $definition) : string
    {
        $populator = sprintf('this.get(\'%s\')', $definition->getName());

        if ($definition instanceof DateTimePropertyDefinition) {
            if ($definition->getType() === PropertyDefinition::TYPE_INTEGER) {
                $populator = sprintf(
                    'DateFactory.create(this.get(\'%s\'))',
                    $definition->getName()
                );
            } else {
                $populator = sprintf(
                    'new %s(this.get(\'%s\'));',
                    self::DATETIME_INSTANCE,
                    $definition->getName()
                );
            }
        } elseif ($definition->getType() === PropertyDefinition::TYPE_REFERENCE) {
            $populator = sprintf(
                'new %s(this.get(\'%s\'))',
                $definition->getReference(),
                $definition->getName()
            );
        }

        return $populator;
    }
}
