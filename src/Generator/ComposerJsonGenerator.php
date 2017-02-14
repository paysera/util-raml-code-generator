<?php

namespace Paysera\Util\RamlCodeGenerator\Generator;

use Paysera\Util\RamlCodeGenerator\Entity\Definition\ApiDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\SourceCode;
use Twig_Environment;

class ComposerJsonGenerator implements GeneratorInterface
{
    private $twig;

    public function __construct(
        Twig_Environment $twig
    ) {
        $this->twig = $twig;
    }

    public function generate(ApiDefinition $definition)
    {
        $code = $this->twig->render('Client/composer.json.twig', [
            'api' => $definition,
        ]);

        $item = new SourceCode();
        $item
            ->setFilepath('composer.json')
            ->setContents($code)
        ;

        return [$item];
    }
}
