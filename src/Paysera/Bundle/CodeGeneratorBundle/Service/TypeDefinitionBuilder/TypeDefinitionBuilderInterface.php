<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;

interface TypeDefinitionBuilderInterface
{
    /**
     * @param string $name
     * @param array $definition
     *
     * @return bool
     */
    public function supports(string $name, array $definition);

    /**
     * @param string $name
     * @param array $definition
     *
     * @return TypeDefinition|null
     */
    public function buildTypeDefinition(string $name, array $definition);
}
