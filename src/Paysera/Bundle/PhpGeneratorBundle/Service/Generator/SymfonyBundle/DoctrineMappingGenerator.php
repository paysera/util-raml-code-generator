<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator\SymfonyBundle;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\FilterTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Paysera\Bundle\CodeGeneratorBundle\Service\TypeConfigurationProvider;
use Paysera\Bundle\CodeGeneratorBundle\Service\UsedTypesResolver;
use Symfony\Component\Templating\EngineInterface;

class DoctrineMappingGenerator implements GeneratorInterface
{
    private $twig;
    private $typeConfigurationProvider;
    private $usedTypesResolver;
    private $stringConverter;

    public function __construct(
        EngineInterface $twig,
        TypeConfigurationProvider $typeConfigurationProvider,
        UsedTypesResolver $usedTypesResolver,
        StringConverter $stringConverter
    ) {
        $this->twig = $twig;
        $this->typeConfigurationProvider = $typeConfigurationProvider;
        $this->usedTypesResolver = $usedTypesResolver;
        $this->stringConverter = $stringConverter;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $items = [];
        $usedTypes = $this->usedTypesResolver->resolveUsedTypes($definition);

        foreach ($usedTypes as $typeName) {
            $type = $definition->getType($typeName);
            if ($this->skipTypeGeneration($type)) {
                continue;
            }

            $items[] = $this->generateMapping($type, $definition);
        }

        return $items;
    }

    private function generateMapping(TypeDefinition $type, ApiDefinition $definition)
    {
        $code = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle/Resources/config/doctrine:Entity.orm.xml.twig',
            [
                'type' => $type,
                'api' => $definition,
            ]
        );
        return (new SourceCode())
            ->setFilepath(sprintf('Resources/config/doctrine/%s.orm.xml', $this->stringConverter->extractTypeName($type->getName())))
            ->setContents($code)
        ;
    }

    private function skipTypeGeneration(TypeDefinition $type)
    {
        $typeConfig = $this->typeConfigurationProvider->getTypeConfiguration($type->getName());
        return
            $typeConfig->getLibraryConfiguration() !== null
            || $type instanceof ResultTypeDefinition
            || $type instanceof FilterTypeDefinition
        ;
    }
}
