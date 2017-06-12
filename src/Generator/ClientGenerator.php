<?php
declare(strict_types=1);

namespace Paysera\Util\RamlCodeGenerator\Generator;

use Paysera\Util\RamlCodeGenerator\Entity\Definition\ApiDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\SourceCode;
use Paysera\Util\RamlCodeGenerator\Service\StringConverter;
use Twig_Environment;

class ClientGenerator implements GeneratorInterface
{
    private $converter;
    private $twig;

    public function __construct(
        StringConverter $converter,
        Twig_Environment $twig
    ) {
        $this->converter = $converter;
        $this->twig = $twig;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $code = $this->twig->render(
            'Client/Client/Client.php.twig',
            [
                'api' => $definition,
            ]
        );

        $item = (new SourceCode())
            ->setFilepath(sprintf('src/%sClient.php', $this->converter->convertSlugToClassName($definition->getName())))
            ->setContents($code)
        ;

        return [$item];
    }
}
