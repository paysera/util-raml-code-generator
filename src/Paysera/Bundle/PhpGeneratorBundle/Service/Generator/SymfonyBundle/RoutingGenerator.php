<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Service\Generator\SymfonyBundle;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

class RoutingGenerator implements GeneratorInterface
{
    private $twig;

    public function __construct(
        EngineInterface $twig
    ) {
        $this->twig = $twig;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $items = [];
        $version = 1;
        $vendorName = explode('\\', $definition->getNamespace())[0];
        if (preg_match('#(\d+)#', (string)$definition->getRamlDefinition()->getVersion(), $matches) === 1) {
            $version = $matches[1];
        }

        $code = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle/Resources/config/routing:Rest.xml.twig',
            [
                'api' => $definition,
                'vendor_name' => $vendorName,
            ]
        );
        $items[] = (new SourceCode())
            ->setContents($code)
            ->setFilepath(sprintf('Resources/config/routing/rest_v%d.xml', $version))
        ;

        $baseUri = parse_url($definition->getRamlDefinition()->getBaseUri(), PHP_URL_PATH);
        $routingCode = $this->twig->render(
            'PayseraPhpGeneratorBundle:SymfonyBundle/Resources/config:Routing.xml.twig',
            [
                'base_uri' => $baseUri,
                'version' => $version,
                'api' => $definition,
            ]
        );
        $items[] = (new SourceCode())
            ->setContents($routingCode)
            ->setFilepath('Resources/config/routing.xml');

        return $items;
    }
}
