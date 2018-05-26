<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Symfony\Component\Templating\EngineInterface;

class ClientGenerator implements GeneratorInterface
{
    private $converter;
    private $twig;
    private $sourceDir;

    public function __construct(
        StringConverter $converter,
        EngineInterface $twig,
        string $sourceDir
    ) {
        $this->converter = $converter;
        $this->twig = $twig;
        $this->sourceDir = $sourceDir;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $code = $this->twig->render(
            'PayseraJavascriptGeneratorBundle:Package/Src/Service:Client.js.twig',
            [
                'api' => $definition,
            ]
        );

        $item = (new SourceCode())
            ->setFilepath(sprintf(
                '%s/service/%s.js',
                $this->sourceDir,
                $this->converter->convertSlugToClassName($definition->getName())
            ))
            ->setContents($code)
        ;

        return [$item];
    }
}
