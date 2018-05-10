<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;

class NamespaceHelper
{
    const NAMESPACE_PREFIX = 'Entities\\';

    public function buildNamespace(string $type): string
    {
        if ($type === ArgumentDefinition::TYPE_DEFAULT) {
            return ArgumentDefinition::TYPE_DEFAULT;
        }
        return self::NAMESPACE_PREFIX . $type;
    }
}
