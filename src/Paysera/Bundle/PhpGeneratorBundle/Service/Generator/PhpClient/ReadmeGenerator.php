<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator\PhpClient;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class ReadmeGenerator implements GeneratorInterface
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
        $contents = $this->twig->render(
            'PayseraPhpGeneratorBundle:RestClient:readme.md.twig',
            [
                'api' => $definition,
                'vendor_prefix' => $this->vendorPrefix,
            ]
        );

        return [(new SourceCode())->setFilepath('README.md')->setContents($contents)];
    }
}
