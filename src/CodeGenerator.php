<?php
declare(strict_types=1);

namespace Paysera\Util\RamlCodeGenerator;

use Paysera\Util\RamlCodeGenerator\Entity\SourceCode;
use Paysera\Util\RamlCodeGenerator\Exception\InvalidApiNameException;
use Paysera\Util\RamlCodeGenerator\Generator\GeneratorInterface;
use Raml\Parser;
use Symfony\Component\Filesystem\Filesystem;

class CodeGenerator
{
    /**
     * @var GeneratorInterface[]
     */
    private $generators;

    private $ramlParser;
    private $filesystem;
    private $definitionTransformer;
    private $ramlDir;
    private $outputDir;

    /**
     * @param Parser $ramlParser
     * @param Filesystem $filesystem
     * @param DefinitionDecorator $definitionTransformer
     * @param string $ramlDir
     * @param string $outputDir
     */
    public function __construct(
        Parser $ramlParser,
        Filesystem $filesystem,
        DefinitionDecorator $definitionTransformer,
        $ramlDir,
        $outputDir
    ) {
        $this->ramlParser = $ramlParser;
        $this->filesystem = $filesystem;
        $this->definitionTransformer = $definitionTransformer;
        $this->ramlDir = $ramlDir;
        $this->outputDir = $outputDir;

        $this->generators = [];
    }

    public function addGenerator(GeneratorInterface $generator)
    {
        $this->generators[] = $generator;
    }

    /**
     * @param string $apiName
     * @param string $namespace
     *
     * @throws InvalidApiNameException
     */
    public function generateCode(string $apiName, string $namespace)
    {
        $ramlFile = sprintf('%s/%s/api.raml', $this->ramlDir, $apiName);
        if (!$this->filesystem->exists($ramlFile)) {
            throw new InvalidApiNameException(sprintf('Cannot find "%s" file', $ramlFile));
        }

        $apiDefinition = $this->definitionTransformer->decorate(
            $this->ramlParser->parse($ramlFile),
            $apiName,
            $namespace
        );

        $items = [];
        foreach ($this->generators as $generator) {
            $items[] = $generator->generate($apiDefinition);
        }

        /** @var SourceCode[] $items */
        $items = call_user_func_array('array_merge', $items);

        foreach ($items as $item) {
            $this->filesystem->dumpFile(
                sprintf('%s/%s/%s', $this->outputDir, $apiName, $item->getFilepath()),
                $item->getContents()
            );
        }
    }
}
