<?php

namespace Paysera\Util\RamlCodeGenerator\Twig;

use Paysera\Util\RamlCodeGenerator\Entity\Definition\ApiDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\ArgumentDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\TypeDefinition;
use Twig_Extension;
use Twig_SimpleFunction;

class TypeDefinitionExtension extends Twig_Extension
{
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('get_type_definition', [$this, 'getTypeDefinition']),
        ];
    }

    /**
     * @param ArgumentDefinition $argumentDefinition
     * @param ApiDefinition $api
     * @return TypeDefinition|null
     */
    public function getTypeDefinition(ArgumentDefinition $argumentDefinition, ApiDefinition $api)
    {
        return $api->getType($argumentDefinition->getType());
    }
}
