<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\FilterTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Service\TypeDefinitionBuilder\TypeDefinitionBuilderInterface;
use Paysera\Component\TypeHelper;
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
        /** @var TypeDefinition[] $types */
        $types = [];
        /** @var FilterTypeDefinition[] $filters */
        $filters = [];

        $apiTypes = array_merge($api->getTypes()->toArray(), $api->getTraits()->toArray());

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

        $types = array_filter($types);

        foreach ($types as $type) {
            if (
                !TypeHelper::isPrimitiveType($type->getType())
                && $type->getParent() === null
            ) {
                foreach ($types as $typeInner) {
                    if ($type->getType() === $typeInner->getName()) {
                        $type->setParent($typeInner);
                    }
                }
            }
        }

        return $types;
    }
}
