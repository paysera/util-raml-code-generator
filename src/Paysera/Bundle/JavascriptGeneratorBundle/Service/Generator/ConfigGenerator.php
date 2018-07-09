<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class ConfigGenerator implements GeneratorInterface
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
        $files = [
            ['src' => '.babelrc.json', 'dest' => '.babelrc'],
            ['src' => '.eslintrc.json', 'dest' => '.eslintrc'],
            ['src' => 'webpack-config.js', 'dest' => 'webpack-config.js'],
        ];

        $result = [];
        foreach ($files as $file) {
            $code = $this->twig->render(
                sprintf('PayseraJavascriptGeneratorBundle:Package:%s.twig', $file['src']),
                [
                    'api' => $definition,
                    'vendor_prefix' => $this->vendorPrefix,
                ]
            );

            $result[] = (new SourceCode())
                ->setFilepath(sprintf('%s', $file['dest']))
                ->setContents($code)
            ;
        }

        return $result;
    }
}
