<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\FilterTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class EntityGenerator implements GeneratorInterface
{
    private $twig;

    public function __construct(
        EngineInterface $twig
    ) {
        $this->twig = $twig;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $items = [];
        foreach ($definition->getTypes() as $type) {
            if ($type instanceof ResultTypeDefinition) {
                $template = 'PayseraPhpGeneratorBundle:RestClient/Entity:Result.php.twig';
            } elseif ($type instanceof FilterTypeDefinition) {
                $template = 'PayseraPhpGeneratorBundle:RestClient/Entity:Filter.php.twig';
            } else {
                $template = 'PayseraPhpGeneratorBundle:RestClient/Entity:Entity.php.twig';
            }

            $code = $this->twig->render($template, [
                'type' => $type,
                'api' => $definition,
            ]);

            $item = new SourceCode();
            $item
                ->setFilepath(sprintf('src/Entity/%s.php', $type->getName()))
                ->setContents($code)
            ;

            $items[] = $item;
        }

        return $items;
    }
}
