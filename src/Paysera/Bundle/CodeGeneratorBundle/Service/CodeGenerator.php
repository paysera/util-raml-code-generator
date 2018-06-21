<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Exception\InvalidApiNameException;
use Paysera\Bundle\CodeGeneratorBundle\Exception\UnrecognizedTypeException;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\CodeGeneratorInterface;
use Raml\Parser;
use Symfony\Component\Filesystem\Filesystem;

class CodeGenerator
{
    /**
     * @var CodeGeneratorInterface[]
     */
    private $generators;

    private $ramlParser;
    private $filesystem;
    private $definitionDecorator;
    private $methodNameBuilder;

    public function __construct(
        Parser $ramlParser,
        Filesystem $filesystem,
        DefinitionDecorator $definitionDecorator,
        MethodNameBuilder $methodNameBuilder
    ) {
        $this->ramlParser = $ramlParser;
        $this->filesystem = $filesystem;
        $this->definitionDecorator = $definitionDecorator;
        $this->methodNameBuilder = $methodNameBuilder;

        $this->generators = [];
    }

    public function addCodeGenerator(CodeGeneratorInterface $generator, string $type)
    {
        $this->generators[$type] = $generator;
    }

    /**
     * @param string $type
     * @param string $name
     * @param string $namespace
     * @param string $ramlFile
     * @param string $outputDir
     *
     * @throws InvalidApiNameException
     * @throws UnrecognizedTypeException
     */
    public function generateCode(
        string $type,
        string $name,
        string $namespace,
        string $ramlFile,
        string $outputDir
    ) {
        if (!isset($this->generators[$type])) {
            throw new UnrecognizedTypeException(sprintf('Cannot generate Code for %s type', $type));
        }

        if (!$this->filesystem->exists($ramlFile)) {
            throw new InvalidApiNameException(sprintf('Cannot find "%s" file', $ramlFile));
        }

        $apiDefinition = $this->definitionDecorator->decorate(
            $this->ramlParser->parse($ramlFile),
            $name,
            $namespace
        );

        $resources = [];
        foreach ($apiDefinition->getRamlDefinition()->getResources() as $resource) {
            $entityName = $this->methodNameBuilder->getMethodEntityName($resource);
            if (isset($resources[$entityName])) {
                $resources[$entityName]->addResource($resource);
                $apiDefinition->getRamlDefinition()->removeResource($resource);
            } else {
                $resources[$entityName] = $resource;
            }
        }

        $sourceFiles = $this->generators[$type]->generate($apiDefinition);

        foreach ($sourceFiles as $item) {
            $this->filesystem->dumpFile(
                sprintf('%s/%s', $outputDir, $item->getFilepath()),
                $item->getContents()
            );
        }
    }
}
