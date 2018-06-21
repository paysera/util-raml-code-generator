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

class NormalizerGenerator implements GeneratorInterface
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
            $typeConfig = $this->typeConfigurationProvider->getTypeConfiguration($type->getName());
            if (
                $typeConfig->getLibraryConfiguration() !== null
                && $typeConfig->getNormalizerImportString() === null
            ) {
                continue;
            }
            if ($type instanceof ResultTypeDefinition) {
                $generatedTypes[] = $type;
                continue;
            }
            if ($typeConfig->getNormalizerImportString() !== null) {
                $generatedTypes[] = $type;
                continue;
            }
            $generatedTypes[] = $type;

            $items[] = $this->generateNormalizerClass($type, $definition);
        }

        $items[] = $this->generateNormalizersXml($generatedTypes, $definition);

        return $items;
    }

    /**
     * @param TypeDefinition[] $types
     * @param ApiDefinition $definition
     * @return SourceCode
     */
    private function generateNormalizersXml(array $types, ApiDefinition $definition)
    {
        $vendorName = explode('\\', $definition->getNamespace())[0];
        $code = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle/Resources/config/services:Normalizers.xml.twig',
            [
                'types' => $types,
                'api' => $definition,
                'vendor_name' => $vendorName,
            ]
        );

        return (new SourceCode())
            ->setFilepath(sprintf('Resources/config/services/normalizers.xml'))
            ->setContents($code)
        ;
    }

    private function generateNormalizerClass(TypeDefinition $type, ApiDefinition $definition)
    {
        if ($type instanceof FilterTypeDefinition) {
            $template = 'PayseraPhpGeneratorBundle:SymfonyBundle/Normalizer:Filter.php.twig';
        } else {
            $template = 'PayseraPhpGeneratorBundle:SymfonyBundle/Normalizer:Entity.php.twig';
        }

        $code = $this->twig->render($template, [
            'type' => $type,
            'api' => $definition,
        ]);

        return (new SourceCode())
            ->setFilepath(sprintf('Normalizer/%sNormalizer.php', $this->stringConverter->extractTypeName($type->getName())))
            ->setContents($code)
        ;
    }
}
