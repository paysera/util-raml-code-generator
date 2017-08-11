<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class GitIgnoreGenerator implements GeneratorInterface
{
    private $twig;

    public function __construct(EngineInterface $twig)
    {
        $this->twig = $twig;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $source = (new SourceCode())
            ->setFilepath('.gitignore')
            ->setContents($this->twig->render('PayseraJavascriptGeneratorBundle:Package:gitignore.txt.twig'))
        ;

        return [$source];
    }
}
