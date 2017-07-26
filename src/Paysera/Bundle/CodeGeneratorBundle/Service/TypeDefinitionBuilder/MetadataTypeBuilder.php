<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder;

class MetadataTypeBuilder implements TypeDefinitionBuilderInterface
{
    public function supports(string $name, array $definition): bool
    {
        return strpos(strtolower($name), 'metadata') !== false
            || strpos(strtolower($name), 'meta data') !== false
        ;
    }

    public function buildTypeDefinition(string $name, array $definition)
    {
        return null;
    }
}
