<?php

declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class IndexDTsGenerator implements GeneratorInterface
{
    private $twig;

    public function __construct(EngineInterface $twig)
    {
        $this->twig = $twig;
    }

    public function generate(ApiDefinition $definition): array
    {
        $source = (new SourceCode())
            ->setFilepath('index.d.ts')
            ->setContents($this->twig->render(
                'PayseraJavascriptGeneratorBundle:Package:index.d.ts.twig',
                ['api' => $definition]
            ))
        ;

        return [$source];
    }
}
