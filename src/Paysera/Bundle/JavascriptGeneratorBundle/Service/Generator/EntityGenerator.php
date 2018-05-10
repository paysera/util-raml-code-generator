<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service\Generator;

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

class EntityGenerator implements GeneratorInterface
{
    private $twig;
    private $sourceDir;
    private $typeConfigurationProvider;
    private $usedTypesResolver;
    private $stringConverter;

    public function __construct(
        EngineInterface $twig,
        string $sourceDir,
        TypeConfigurationProvider $typeConfigurationProvider,
        UsedTypesResolver $usedTypesResolver,
        StringConverter $stringConverter
    ) {
        $this->twig = $twig;
        $this->sourceDir = $sourceDir;
        $this->typeConfigurationProvider = $typeConfigurationProvider;
        $this->usedTypesResolver = $usedTypesResolver;
        $this->stringConverter = $stringConverter;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $items = [];
        $usedTypes = $this->usedTypesResolver->resolveUsedTypes($definition);
        foreach ($usedTypes as $typName) {
            $type = $definition->getType($typName);
            if ($this->skipTypeGeneration($type)) {
                continue;
            }

            if ($type instanceof ResultTypeDefinition) {
                $template = 'PayseraJavascriptGeneratorBundle:Package/Src/Entity:Result.js.twig';
            } elseif ($type instanceof FilterTypeDefinition) {
                $template = 'PayseraJavascriptGeneratorBundle:Package/Src/Entity:Filter.js.twig';
            } else {
                $template = 'PayseraJavascriptGeneratorBundle:Package/Src/Entity:Entity.js.twig';
            }

            $code = $this->twig->render(
                $template,
                [
                    'type' => $type,
                    'api' => $definition,
                ]
            );

            $items[] = (new SourceCode())
                ->setFilepath(sprintf(
                    '%s/entity/%s.js',
                    $this->sourceDir,
                    $this->stringConverter->extractTypeName($type->getName())
                ))
                ->setContents($code)
            ;
        }

        return $items;
    }

    private function skipTypeGeneration(TypeDefinition $type)
    {
        $typeConfig = $this->typeConfigurationProvider->getTypeConfiguration($type->getName());
        return $typeConfig->getLibraryConfiguration() !== null;
    }
}
