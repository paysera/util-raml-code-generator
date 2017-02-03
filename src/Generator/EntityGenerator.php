<?php

namespace Paysera\Util\RamlCodeGenerator\Generator;

use Paysera\Util\RamlCodeGenerator\Entity\Definition\ApiDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\FilterTypeDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\SourceCode;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\ResultTypeDefinition;
use Twig_Environment;

class EntityGenerator implements GeneratorInterface
{
    private $twig;

    public function __construct(
        Twig_Environment $twig
    ) {
        $this->twig = $twig;
    }

    public function generate(ApiDefinition $definition)
    {
        $items = [];
        foreach ($definition->getTypes() as $type) {
            if ($type instanceof ResultTypeDefinition) {
                $template = 'Client/Entity/Result.php.twig';
            } elseif ($type instanceof FilterTypeDefinition) {
                $template = 'Client/Entity/Filter.php.twig';
            } else {
                $template = 'Client/Entity/Entity.php.twig';
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
