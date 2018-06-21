<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator\SymfonyBundle;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Paysera\Bundle\CodeGeneratorBundle\Service\MethodNameBuilder;
use Symfony\Component\Templating\EngineInterface;

class ApiGenerator implements GeneratorInterface
{
    private $twig;
    private $methodNameBuilder;

    public function __construct(
        EngineInterface $twig,
        MethodNameBuilder $methodNameBuilder
    ) {
        $this->twig = $twig;
        $this->methodNameBuilder = $methodNameBuilder;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $resources = [];
        foreach ($definition->getRamlDefinition()->getResources() as $resource) {
            $entityName = $this->methodNameBuilder->getMethodEntityName($resource);
            $resources[$entityName] = $resource;
        }

        $vendorName = explode('\\', $definition->getNamespace())[0];
        $apiCode = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle/Resources/config/services:Api.xml.twig',
            [
                'vendor_name' => $vendorName,
                'api' => $definition,
                'resources' => $resources,
            ]
        );
        return [
            (new SourceCode())
                ->setContents($apiCode)
                ->setFilepath('Resources/config/services/api.xml')
        ];
    }
}
