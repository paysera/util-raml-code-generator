<?php

namespace Paysera\Util\RamlCodeGenerator\Generator;

use Paysera\Util\RamlCodeGenerator\Entity\Definition\ApiDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\SourceCode;
use Twig_Environment;

class ReadmeGenerator implements GeneratorInterface
{
    private $twig;
    private $vendorPrefix;

    /**
     * @param Twig_Environment $twig
     * @param string $vendorPrefix
     */
    public function __construct(
        Twig_Environment $twig,
        $vendorPrefix
    ) {
        $this->twig = $twig;
        $this->vendorPrefix = $vendorPrefix;
    }

    public function generate(ApiDefinition $definition)
    {
        $contents = $this->twig->render('Client/readme.md.twig', [
            'api' => $definition,
            'vendor_prefix' => $this->vendorPrefix,
        ]);

        $item = new SourceCode();
        $item
            ->setFilepath('README.md')
            ->setContents($contents)
        ;

        return [$item];
    }
}
