<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator\SymfonyBundle;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Symfony\Component\Templating\EngineInterface;

class BundleGenerator implements GeneratorInterface
{
    private $twig;
    private $stringConverter;

    public function __construct(
        EngineInterface $twig,
        StringConverter $stringConverter
    ) {
        $this->twig = $twig;
        $this->stringConverter = $stringConverter;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $vendorName = explode('\\', $definition->getNamespace())[0];
        $params = [
            'api' => $definition,
            'vendor_name' => $vendorName,
        ];

        $configurationCode = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle/DependencyInjection:Configuration.php.twig',
            $params
        );
        $extensionCode = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle/DependencyInjection:Extension.php.twig',
            $params
        );
        $bundleCode = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle:Bundle.php.twig',
            $params
        );

        $vendor = ucfirst($vendorName);
        $bundleName = $definition->getName();

        return [
            (new SourceCode())
                ->setContents($configurationCode)
                ->setFilepath('DependencyInjection/Configuration.php'),
            (new SourceCode())
                ->setContents($extensionCode)
                ->setFilepath(sprintf('DependencyInjection/%s%sExtension.php', $vendor, $bundleName)),
            (new SourceCode())
                ->setContents($bundleCode)
                ->setFilepath(sprintf('%s%sBundle.php', $vendor, $bundleName)),
        ];
    }
}
