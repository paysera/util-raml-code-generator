<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimeTypeDefinition;
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
    private $dateTimeBuilder;

    public function __construct(
        TypeDefinitionBuilderInterface $dateTimeBuilder
    ) {
        $this->builders = [];
        $this->dateTimeBuilder = $dateTimeBuilder;
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
        /** @var TypeDefinition[] $singles */
        $singles = [];

        $apiTypes = array_merge($api->getTypes()->toArray(), $api->getTraits()->toArray());

        foreach ($apiTypes as $name => $definition) {
            if ($this->dateTimeBuilder->supports($name, $definition)) {
                $type = $this->dateTimeBuilder->buildTypeDefinition($name, $definition);
                if ($type instanceof DateTimeTypeDefinition) {
                    $singles[DateTimeTypeDefinition::NAME] = $type;
                }
            }
            foreach ($this->builders as $builder) {
                if ($builder->supports($name, $definition)) {
                    $types[] = $builder->buildTypeDefinition($name, $definition);
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

        return array_merge($types, array_values($singles));
    }
}
