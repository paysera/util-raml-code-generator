<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class ClientFactoryGenerator implements GeneratorInterface
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
        $baseUrl = $definition->getRamlDefinition()->getBaseUrl();

        $code = $this->twig->render(
            'PayseraJavascriptGeneratorBundle:Package/Src/Service:ClientFactory.js.twig',
            [
                'base_url' => rtrim($baseUrl, '/') . '/',
                'api' => $definition,
            ]
        );

        $item = (new SourceCode())
            ->setFilepath(sprintf('%s/service/ClientFactory.js', $this->sourceDir))
            ->setContents($code)
        ;

        return [$item];
    }
}
