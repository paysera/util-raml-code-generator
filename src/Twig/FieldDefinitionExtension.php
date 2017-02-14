<?php

namespace Paysera\Util\RamlCodeGenerator\Twig;

use Doctrine\Common\Inflector\Inflector;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\PropertyDefinition;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class FieldDefinitionExtension extends Twig_Extension
{
    const DATETIME_REGEX = '#timestamp|date|time#i';
    const DATETIME_INSTANCE = '\\DateTimeImmutable';
    const DATETIME_INTERFACE = '\\DateTimeInterface';

    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('to_variable_name', [$this, 'toVariableName']),
        ];
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('generate_getter_name', [$this, 'generateGetterName']),
            new Twig_SimpleFunction('generate_setter_name', [$this, 'generateSetterName']),
            new Twig_SimpleFunction('generate_typehint', [$this, 'generateTypehint']),
            new Twig_SimpleFunction('generate_doc_block', [$this, 'generateDocBlock']),
            new Twig_SimpleFunction('generate_value_extractor', [$this, 'generateValueExtractor'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('generate_value_populator', [$this, 'generateValuePopulator'], ['is_safe' => ['html']]),
        ];
    }

    public function toVariableName($string)
    {
        return lcfirst(Inflector::classify($string));
    }

    public function generateGetterName(PropertyDefinition $definition)
    {
        $prefix = 'get';
        if ($definition->getType() === PropertyDefinition::TYPE_BOOLEAN) {
            $prefix = 'is';
        }

        return $prefix . ucfirst($this->toVariableName($definition->getName()));
    }

    public function generateSetterName(PropertyDefinition $definition)
    {
        return 'set' . ucfirst($this->toVariableName($definition->getName()));
    }

    /**
     * @param PropertyDefinition $definition
     * @param bool $forGetter
     * @return string
     */
    public function generateDocBlock(PropertyDefinition $definition, $forGetter)
    {
        $typehint = $definition->getType();

        if ($definition->getType() === PropertyDefinition::TYPE_REFERENCE) {
            $typehint = $definition->getReference();
        } elseif ($definition instanceof ArrayPropertyDefinition) {
            $typehint = $definition->getItemsType() . '[]';
        } elseif ($this->isDateTimeInstance($definition)) {
            if ($forGetter) {
                $typehint = self::DATETIME_INSTANCE;
            } else {
                $typehint = self::DATETIME_INTERFACE;
            }
        }

        if ($forGetter) {
            if (!$definition->isRequired()) {
                $typehint .= '|null';
                return $typehint;
            }
            return $typehint;
        }

        return sprintf('%s $%s', $typehint, $this->toVariableName($definition->getName()));
    }

    public function generateTypehint(PropertyDefinition $definition, $forGetter = false)
    {
        $typehint = null;

        if ($definition->getType() === PropertyDefinition::TYPE_REFERENCE) {
            $typehint = $definition->getReference();
        } elseif ($definition->getType() === PropertyDefinition::TYPE_ARRAY) {
            $typehint = PropertyDefinition::TYPE_ARRAY;
        } elseif ($this->isDateTimeInstance($definition)) {
            if ($forGetter) {
                $typehint = self::DATETIME_INSTANCE;
            } else {
                $typehint = self::DATETIME_INTERFACE;
            }
        }

        return trim(sprintf('%s $%s', $typehint, $this->toVariableName($definition->getName())));
    }

    public function generateReturnType(PropertyDefinition $definition)
    {
        $returnType = $this->generateTypehint($definition, true);

        if ($returnType === null) {
            $returnType = $definition->getType();
        }

        if (!$definition->isRequired()) {
            $returnType .= '|null';
        }

        return $returnType;
    }

    public function generateValueExtractor(PropertyDefinition $definition)
    {
        $extractor = '$' . $this->toVariableName($definition->getName());

        if ($this->isDateTimeInstance($definition)) {
            $extractor .= '->getTimestamp()';
            return sprintf('$this->set(\'%s\', %s)', $definition->getName(), $extractor);
        } elseif ($definition->getType() === PropertyDefinition::TYPE_REFERENCE) {
            $extractor .= '->getDataByReference()';
            return sprintf('$this->setByReference(\'%s\', %s)', $definition->getName(), $extractor);
        } else {
            return sprintf('$this->set(\'%s\', %s)', $definition->getName(), $extractor);
        }
    }

    public function generateValuePopulator(PropertyDefinition $definition)
    {
        if (
            in_array(
                $definition->getType(),
                [
                    PropertyDefinition::TYPE_STRING,
                    PropertyDefinition::TYPE_INTEGER,
                    PropertyDefinition::TYPE_BOOLEAN,
                ],
                true
            )
            || (
                $definition instanceof ArrayPropertyDefinition
                && in_array($definition->getItemsType(), PropertyDefinition::getSimpleTypes(), true)
            )
        ) {
            $populator = sprintf('$this->get(\'%s\')', $definition->getName());
        } else {
            $populator = sprintf('$this->getByReference(\'%s\')', $definition->getName());
        }

        if ($this->isDateTimeInstance($definition)) {
            if ($definition->getType() === PropertyDefinition::TYPE_INTEGER) {
                $populator = sprintf(
                    '(new %s())->setTimestamp($this->get(\'%s\'))',
                    self::DATETIME_INSTANCE,
                    $definition->getName()
                );
            } else {
                $populator = sprintf(
                    'new %s($this->get(\'%s\'));',
                    self::DATETIME_INSTANCE,
                    $definition->getName()
                );
            }
        } elseif ($definition->getType() === PropertyDefinition::TYPE_REFERENCE) {
            $populator = sprintf(
                '(new %s())->setDataByReference($this->getByReference(\'%s\'))',
                $definition->getReference(),
                $definition->getName()
            );
        }

        return $populator;
    }

    private function isDateTimeInstance(PropertyDefinition $definition)
    {
        return
            in_array($definition->getType(), [PropertyDefinition::TYPE_INTEGER, PropertyDefinition::TYPE_STRING], true)
            && preg_match(self::DATETIME_REGEX, $definition->getDescription()) === 1
        ;
    }
}
