<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Exception\InvalidDefinitionException;

class ResultTypeBuilder implements TypeDefinitionBuilderInterface
{
    const ANNOTATION_ENTITY = '(entity_type)';
    const PATTERN_METADATA_SUFFIX = '/meta[\s_-]*data$/i';

    /**
     * The name is matched loosely, so a domain type ending in "Metadata" has to be excluded
     * explicitly: it is an entity of its own, and only `ResultMetadata` is supplied by the REST
     * client runtime. Without this, such a type is shaped as a result envelope instead.
     */
    public function supports(string $name, array $definition): bool
    {
        return strpos($name, 'Result') !== false
            && preg_match(self::PATTERN_METADATA_SUFFIX, $name) !== 1
            && !array_key_exists(self::ANNOTATION_ENTITY, $definition);
    }

    public function buildTypeDefinition(string $name, array $definition)
    {
        $type = new ResultTypeDefinition();
        $type
            ->setName($name)
            ->setType(isset($definition['type']) ? $definition['type'] : null)
            ->setDisplayName(isset($definition['displayName']) ? $definition['displayName'] : null)
        ;

        if (empty($definition['properties'])) {
            throw new InvalidDefinitionException('ResultType definition must contain "properties" list');
        }

        $possibleKeys = array_diff(array_keys($definition['properties']), ['_metadata']);
        $itemsType = null;
        $dataKey = null;
        if (count($possibleKeys) > 0) {
            $dataKey = $possibleKeys[0];
            if (isset($definition['properties'][$dataKey]['items'])) {
                $itemsType = $definition['properties'][$dataKey]['items']['type'];
            }
        }

        $type
            ->setDataKey($dataKey)
            ->setItemsType($itemsType)
            ->setData($definition)
        ;

        return $type;
    }
}
