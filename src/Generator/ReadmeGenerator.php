<?php
declare(strict_types=1);

namespace Paysera\Util\RamlCodeGenerator\Generator;

use Paysera\Util\RamlCodeGenerator\Entity\Definition\ApiDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\SourceCode;
use Twig_Environment;

class ReadmeGenerator implements GeneratorInterface
{
    private $twig;
    private $vendorPrefix;

    public function __construct(
        Twig_Environment $twig,
        string $vendorPrefix
    ) {
        $this->twig = $twig;
        $this->vendorPrefix = $vendorPrefix;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $contents = $this->twig->render(
            'Client/readme.md.twig',
            [
                'api' => $definition,
                'vendor_prefix' => $this->vendorPrefix,
            ]
        );

        return [(new SourceCode())->setFilepath('README.md')->setContents($contents)];
    }
}
