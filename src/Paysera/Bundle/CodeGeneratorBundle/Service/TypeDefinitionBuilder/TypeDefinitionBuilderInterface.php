<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;

interface TypeDefinitionBuilderInterface
{
    public function supports(string $name, array $definition): bool;

    /**
     * @param string $name
     * @param array $definition
     *
     * @return TypeDefinition|null
     */
    public function buildTypeDefinition(string $name, array $definition);
}
