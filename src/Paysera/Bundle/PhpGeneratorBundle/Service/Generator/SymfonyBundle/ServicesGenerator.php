<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator\SymfonyBundle;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Paysera\Bundle\PhpGeneratorBundle\Twig\BundleExtension;
use Symfony\Component\Templating\EngineInterface;

class ServicesGenerator implements GeneratorInterface
{
    private $twig;
    private $bundleExtension;
    private $stringConverter;

    public function __construct(
        EngineInterface $twig,
        BundleExtension $bundleExtension,
        StringConverter $stringConverter
    ) {
        $this->twig = $twig;
        $this->bundleExtension = $bundleExtension;
        $this->stringConverter = $stringConverter;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $items = [];
        $managers = [];
        $vendorName = explode('\\', $definition->getNamespace())[0];
        foreach ($definition->getRamlDefinition()->getResources() as $resource) {
            foreach ($this->bundleExtension->getControllerConstructorArgs($resource, $definition) as $argumentDefinition) {
                if (strpos($argumentDefinition->getType(), 'Manager') === false) {
                    continue;
                }
                $code = $this->twig->render(
                    'PayseraPhpGeneratorBundle:SymfonyBundle/Service:Manager.php.twig',
                    [
                        'api' => $definition,
                        'vendor_name' => $vendorName,
                        'argument' => $argumentDefinition,
                    ]
                );
                $items[] = (new SourceCode())
                    ->setContents($code)
                    ->setFilepath(sprintf(
                        'Service/%sManager.php',
                        $this->stringConverter->convertSlugToClassName($argumentDefinition->getName())
                    ))
                ;
                $managers[$argumentDefinition->getName()] = $argumentDefinition;
            }
        }

        $xmlCode = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle/Resources/config/services:Services.xml.twig',
            [
                'api' => $definition,
                'vendor_name' => $vendorName,
                'managers' => $managers,
            ]
        );
        $items[] = (new SourceCode())
            ->setContents($xmlCode)
            ->setFilepath('Resources/config/services/services.xml')
        ;

        $servicesCode = $this->twig->render('PayseraPhpGeneratorBundle:SymfonyBundle/Resources/config:Services.xml.twig');
        $items[] = (new SourceCode())
            ->setContents($servicesCode)
            ->setFilepath('Resources/config/services.xml');

        return $items;
    }
}
