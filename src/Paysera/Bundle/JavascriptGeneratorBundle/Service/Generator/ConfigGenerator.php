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
        $result = [];
        foreach (['eslint.json', 'serve.json', 'webpack.js'] as $file) {
            $code = $this->twig->render(
                sprintf('PayseraJavascriptGeneratorBundle:Package/Config:%s.twig', $file),
                [
                    'api' => $definition,
                    'vendor_prefix' => $this->vendorPrefix,
                ]
            );

            $result[] = (new SourceCode())
                ->setFilepath(sprintf('config/%s', $file))
                ->setContents($code)
            ;
        }

        return $result;
    }
}
