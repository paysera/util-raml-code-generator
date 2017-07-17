<?php

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class ComposerJsonGenerator implements GeneratorInterface
{
    private $twig;
    private $vendorPrefix;

    public function __construct(
        EngineInterface $twig,
        string $vendorPrefix
    ) {
        $this->twig = $twig;
        $this->vendorPrefix = $vendorPrefix;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $code = $this->twig->render(
            'PayseraPhpGeneratorBundle:RestClient:composer.json.twig',
            [
                'api' => $definition,
                'vendor_prefix' => $this->vendorPrefix,
            ]
        );

        return [(new SourceCode())->setFilepath('composer.json')->setContents($code)];
    }
}
