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

class RepositoryGenerator implements GeneratorInterface
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
        $generatedTypes = [];

        foreach ($usedTypes as $typeName) {
            $type = $definition->getType($typeName);
            if ($this->skipTypeGeneration($type)) {
                continue;
            }
            $generatedTypes[] = $type;

            $items[] = $this->generateRepositoryClass($type, $definition);
        }

        $items[] = $this->generateRepositoriesXml($generatedTypes, $definition);

        return $items;
    }

    /**
     * @param TypeDefinition[] $types
     * @param ApiDefinition $definition
     * @return SourceCode
     */
    private function generateRepositoriesXml(array $types, ApiDefinition $definition)
    {
        $vendorName = explode('\\', $definition->getNamespace())[0];
        $code = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle/Resources/config/services:Repositories.xml.twig',
            [
                'types' => $types,
                'api' => $definition,
                'vendor_name' => $vendorName,
            ]
        );
        return (new SourceCode())
            ->setFilepath(sprintf('Resources/config/services/repositories.xml'))
            ->setContents($code)
        ;
    }

    private function generateRepositoryClass(TypeDefinition $type, ApiDefinition $definition)
    {
        $code = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle/Entity:Repository.php.twig',
            [
                'type' => $type,
                'api' => $definition,
            ]
        );
        return (new SourceCode())
            ->setFilepath(sprintf('Repository/%sRepository.php', $this->stringConverter->extractTypeName($type->getName())))
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
