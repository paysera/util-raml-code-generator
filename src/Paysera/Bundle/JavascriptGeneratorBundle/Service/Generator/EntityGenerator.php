<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\FilterTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class EntityGenerator implements GeneratorInterface
{
    private $twig;
    private $sourceDir;

    public function __construct(
        EngineInterface $twig,
        string $sourceDir
    ) {
        $this->twig = $twig;
        $this->sourceDir = $sourceDir;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $items = [];
        foreach ($definition->getTypes() as $type) {
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

            $item = new SourceCode();
            $item
                ->setFilepath(sprintf('%s/entity/%s.js', $this->sourceDir, $type->getName()))
                ->setContents($code)
            ;

            $items[] = $item;
        }

        return $items;
    }
}
