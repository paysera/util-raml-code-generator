<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\FilterTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder\TypeDefinitionBuilderInterface;
use Raml\ApiDefinition;

class TypeDefinitionBuilder
{
    /**
     * @var TypeDefinitionBuilderInterface[]
     */
    private $builders;

    public function __construct()
    {
        $this->builders = [];
    }

    public function addTypeDefinitionBuilder(TypeDefinitionBuilderInterface $builder, string $position)
    {
        $this->builders[$position] = $builder;
        ksort($this->builders);
    }

    /**
     * @param ApiDefinition $api
     *
     * @return TypeDefinition[]
     */
    public function buildTypeDefinitions(ApiDefinition $api)
    {
        $types = [];
        $apiTypes = array_merge($api->getTypes(), $api->getTraits());

        $extendsBaseFilter = false;
        /** @var FilterTypeDefinition[] $filters */
        $filters = [];
        foreach ($apiTypes as $name => $definition) {
            foreach ($this->builders as $builder) {
                if ($builder->supports($name, $definition)) {
                    $type = $builder->buildTypeDefinition($name, $definition);
                    if ($type instanceof FilterTypeDefinition) {
                        $filters[] = $type;
                    }
                    $types[] = $type;
                    break;
                }
            }
        }

        foreach ($filters as $filter) {
            if ($filter->isBaseFilter() && count($filters) > 1) {
                $extendsBaseFilter = true;
                $filter->setGeneratable(false);
                break;
            }
        }

        if ($extendsBaseFilter) {
            foreach ($types as $type) {
                if (
                    $type instanceof FilterTypeDefinition
                    && $type->getName() !== FilterTypeDefinition::BASE_FILTER
                ) {
                    $type->setExtendsBaseFilter(true);
                }
            }
        }

        return array_filter($types);
    }
}
