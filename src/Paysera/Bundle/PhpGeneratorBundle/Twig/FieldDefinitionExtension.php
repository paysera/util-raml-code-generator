<?php

namespace Paysera\Bundle\PhpGeneratorBundle\Twig;

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
        ];
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
