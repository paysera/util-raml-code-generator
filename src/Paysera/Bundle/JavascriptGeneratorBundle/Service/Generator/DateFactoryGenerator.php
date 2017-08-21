<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class DateFactoryGenerator implements GeneratorInterface
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
        $contents = $this->twig->render('PayseraJavascriptGeneratorBundle:Package/Src/Service:DateFactory.js.twig');

        $code = (new SourceCode())
            ->setFilepath(sprintf('%s/service/DateFactory.js', $this->sourceDir))
            ->setContents($contents)
        ;

        return [$code];
    }
}
