<?php

namespace Paysera\Util\RamlCodeGenerator\Generator;

use Paysera\Util\RamlCodeGenerator\Entity\Definition\ApiDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\SourceCode;
use Twig_Environment;

class ClientGenerator implements GeneratorInterface
{
    private $twig;

    public function __construct(
        Twig_Environment $twig
    ) {
        $this->twig = $twig;
    }

    public function generate(ApiDefinition $definition)
    {
        $code = $this->twig->render('Client/Client/Client.php.twig', [
            'api' => $definition,
        ]);

        $item = new SourceCode();
        $item
            ->setFilepath(sprintf('src/%sClient.php', ucfirst($definition->getName())))
            ->setContents($code)
        ;

        return [$item];
    }
}
