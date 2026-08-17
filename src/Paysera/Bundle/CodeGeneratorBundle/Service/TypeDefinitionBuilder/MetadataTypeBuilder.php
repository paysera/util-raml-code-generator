<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder;

class MetadataTypeBuilder implements TypeDefinitionBuilderInterface
{
    const RESULT_METADATA = 'resultmetadata';

    /**
     * Only the result envelope's own metadata is skipped, because the REST client runtime supplies
     * it. The name arrives qualified by its library when it comes from one, as in
     * `Paysera.ResultMetadata`, so the short name is compared.
     */
    public function supports(string $name, array $definition): bool
    {
        $separatorPosition = strrpos($name, '.');
        $shortName = $separatorPosition === false ? $name : substr($name, $separatorPosition + 1);

        return preg_replace('/[\s_-]+/', '', strtolower($shortName)) === self::RESULT_METADATA;
    }

    public function buildTypeDefinition(string $name, array $definition)
    {
        return null;
    }
}
