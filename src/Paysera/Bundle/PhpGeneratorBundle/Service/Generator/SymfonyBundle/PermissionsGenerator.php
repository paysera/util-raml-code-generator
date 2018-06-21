<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator\SymfonyBundle;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Paysera\Bundle\CodeGeneratorBundle\Service\MethodNameBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Symfony\Component\Templating\EngineInterface;

class PermissionsGenerator implements GeneratorInterface
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
        $vendorName = explode('\\', $definition->getNamespace())[0];
        foreach ($definition->getRamlDefinition()->getResources() as $resource) {
            $entityName = $this->methodNameBuilder->getMethodEntityName($resource);

            $code = $this->twig->render(
                'PayseraPhpGeneratorBundle:SymfonyBundle/Security:Permissions.php.twig',
                [
                    'api' => $definition,
                    'vendor_name' => $vendorName,
                    'entity_name' => $entityName,
                    'resource' => $resource,
                ]
            );

            $items[] = (new SourceCode())
                ->setContents($code)
                ->setFilepath(sprintf(
                    '%sPermissions.php',
                    $this->stringConverter->convertSlugToClassName($entityName)
                ))
            ;
        }

        return $items;
    }
}
