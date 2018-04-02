<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\FilterTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;

class NamespaceHelper
{
    const NAMESPACE_PREFIX = 'Entities\\';
    const REST_CLIENT_NAMESPACE_PREFIX = 'Paysera\\Component\\RestClientCommon\\Entity\\';

    public function buildNamespace(string $type, TypeDefinition $definition = null): string
    {
        if ($type === ArgumentDefinition::TYPE_DEFAULT) {
            return ArgumentDefinition::TYPE_DEFAULT;
        } elseif (
            $type === FilterTypeDefinition::BASE_FILTER
            && $definition !== null
            && !$definition->isGeneratable()
        ) {
            return self::REST_CLIENT_NAMESPACE_PREFIX . $type;
        }

        return self::NAMESPACE_PREFIX . $type;
    }
}
