<?php

namespace Paysera\Bundle\PhpGeneratorBundle\Twig;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;
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
