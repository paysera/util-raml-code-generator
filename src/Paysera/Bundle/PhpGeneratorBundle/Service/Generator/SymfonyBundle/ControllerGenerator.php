<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator\SymfonyBundle;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Paysera\Bundle\CodeGeneratorBundle\Service\MethodNameBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Raml\Resource;
use Symfony\Component\Templating\EngineInterface;

class ControllerGenerator implements GeneratorInterface
{
    private $twig;
    private $methodNameBuilder;
    private $stringConverter;

    public function __construct(
        EngineInterface $twig,
        MethodNameBuilder $methodNameBuilder,
        StringConverter $stringConverter
    ) {
        $this->twig = $twig;
        $this->methodNameBuilder = $methodNameBuilder;
        $this->stringConverter = $stringConverter;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $items = [];
        /** @var Resource[] $resources */
        $resources = [];
        $vendorName = explode('\\', $definition->getNamespace())[0];
        foreach ($definition->getRamlDefinition()->getResources() as $resource) {
            $entityName = $this->methodNameBuilder->getMethodEntityName($resource);
            $resources[$entityName] = $resource;

            $code = $this->twig->render(
                'PayseraPhpGeneratorBundle:SymfonyBundle/Controller:Controller.php.twig',
                [
                    'api' => $definition,
                    'vendor_name' => $vendorName,
                    'resource' => $resource,
                    'entity_name' => $entityName,
                ]
            );
            $items[] = (new SourceCode())
                ->setContents($code)
                ->setFilepath(sprintf(
                    'Controller/%sApiController.php',
                    $this->stringConverter->convertSlugToClassName($entityName)
                ))
            ;
        }

        $xmlCode = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle/Resources/config/services:Controllers.xml.twig',
            [
                'api' => $definition,
                'vendor_name' => $vendorName,
                'resources' => $resources,
            ]
        );

        $items[] = (new SourceCode())
            ->setContents($xmlCode)
            ->setFilepath('Resources/config/services/controllers.xml')
        ;
        return $items;
    }
}
