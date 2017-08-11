<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Raml\ApiDefinition;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition as DecoratedDefinition;

class DefinitionDecorator
{
    private $definitionValidator;
    private $typeDefinitionBuilder;

    public function __construct(
        DefinitionValidator $definitionValidator,
        TypeDefinitionBuilder $typeDefinitionBuilder
    ) {
        $this->definitionValidator = $definitionValidator;
        $this->typeDefinitionBuilder = $typeDefinitionBuilder;
    }

    public function decorate(ApiDefinition $original, string $apiName, string $namespace) : DecoratedDefinition
    {
        $apiDefinition = new DecoratedDefinition($original);
        $types = $this->typeDefinitionBuilder->buildTypeDefinitions($original);

        $apiDefinition
            ->setTypes($types)
            ->setName($apiName)
            ->setNamespace($namespace)
        ;

        $this->definitionValidator->validateDefinition($apiDefinition);

        return $apiDefinition;
    }
}
