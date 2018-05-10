<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Twig;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Service\TypeConfigurationProvider;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class FieldDefinitionExtension extends Twig_Extension
{
    const DATETIME_INSTANCE = 'Date';

    private $stringConverter;
    private $typeConfigurationProvider;

    public function __construct(
        StringConverter $stringConverter,
        TypeConfigurationProvider $typeConfigurationProvider
    ) {
        $this->stringConverter = $stringConverter;
        $this->typeConfigurationProvider = $typeConfigurationProvider;
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('js_generate_getter_name', [$this, 'getGetterName']),
            new Twig_SimpleFunction('js_generate_setter_name', [$this, 'getSetterName']),
            new Twig_SimpleFunction('js_extract_type_name', [$this, 'extractTypeName']),
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
}
