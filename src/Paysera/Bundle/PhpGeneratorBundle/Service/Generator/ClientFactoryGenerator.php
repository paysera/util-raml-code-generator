<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class ClientFactoryGenerator implements GeneratorInterface
{
    private $twig;

    public function __construct(
        EngineInterface $twig
    ) {
        $this->twig = $twig;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $baseUrl = $definition->getRamlDefinition()->getBaseUri();

        $code = $this->twig->render(
            'PayseraPhpGeneratorBundle:RestClient/:Client/ClientFactory.php.twig',
            [
                'base_url' => rtrim($baseUrl, '/') . '/',
                'api' => $definition,
            ]
        );

        $item = (new SourceCode())
            ->setFilepath('src/ClientFactory.php')
            ->setContents($code)
        ;

        return [$item];
    }
}
