<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class ClientGenerator implements GeneratorInterface
{
    private $converter;
    private $twig;

    public function __construct(
        StringConverter $converter,
        EngineInterface $twig
    ) {
        $this->converter = $converter;
        $this->twig = $twig;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $code = $this->twig->render(
            'PayseraPhpGeneratorBundle:RestClient:Client/Client.php.twig',
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
