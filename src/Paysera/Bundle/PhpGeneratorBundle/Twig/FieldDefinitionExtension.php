<?php

namespace Paysera\Bundle\PhpGeneratorBundle\Twig;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimePropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimeTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Twig_Extension;
use Twig_SimpleFunction;

class FieldDefinitionExtension extends Twig_Extension
{
    private $stringConverter;

    public function __construct(
        StringConverter $stringConverter
    ) {
        $this->stringConverter = $stringConverter;
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('php_generate_getter_name', [$this, 'generateGetterName']),
            new Twig_SimpleFunction('php_generate_setter_name', [$this, 'generateSetterName']),
            new Twig_SimpleFunction('php_resolve_date_type_format', [$this, 'resolveDateTypeFormat']),
        ];
    }

    public function resolveDateTypeFormat(DateTimePropertyDefinition $definition)
    {
        $type = $definition->getType();
        if ($type === PropertyDefinition::TYPE_REFERENCE) {
            $type = $definition->getReference();
        }

        switch ($type) {
            case PropertyDefinition::TYPE_INTEGER:
                return 'U';
            case DateTimeTypeDefinition::FORMAT_DATE_ONLY:
                return 'Y-m-d';
            case DateTimeTypeDefinition::FORMAT_TIME_ONLY:
                return 'H:i:s';
            case DateTimeTypeDefinition::FORMAT_DATETIME_ONLY:
                return 'Y-m-d\TH:i:s';
            case DateTimeTypeDefinition::FORMAT_DATETIME:
                if ($definition->getFormat() !== null) {
                    return $definition->getFormat();
                }
                return \DateTimeInterface::RFC3339;
        }
        throw new UnrecognizedTypeException(
            sprintf(
                'Cannot resolve Date format from type "%s"',
                $definition->getType()
            )
        );
    }

    public function generateGetterName(PropertyDefinition $definition)
    {
        $prefix = 'get';
        if ($definition->getType() === PropertyDefinition::TYPE_BOOLEAN) {
            $prefix = 'is';
        }

        return $prefix . ucfirst($this->stringConverter->convertSlugToVariableName($definition->getName()));
    }

    public function generateSetterName(PropertyDefinition $definition)
    {
        return 'set' . ucfirst($this->stringConverter->convertSlugToVariableName($definition->getName()));
    }
}
