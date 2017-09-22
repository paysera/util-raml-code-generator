<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Exception\InvalidApiNameException;
use Paysera\Bundle\CodeGeneratorBundle\Exception\UnrecognizedTypeException;
use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\LanguageCodeGeneratorInterface;
use Raml\Parser;
use Symfony\Component\Filesystem\Filesystem;

class CodeGenerator
{
    /**
     * @var LanguageCodeGeneratorInterface[]
     */
    private $generators;

    private $ramlParser;
    private $filesystem;
    private $definitionTransformer;

    public function __construct(
        Parser $ramlParser,
        Filesystem $filesystem,
        DefinitionDecorator $definitionTransformer
    ) {
        $this->ramlParser = $ramlParser;
        $this->filesystem = $filesystem;
        $this->definitionTransformer = $definitionTransformer;

        $this->generators = [];
    }

    public function addLanguageCodeGenerator(LanguageCodeGeneratorInterface $generator, string $language)
    {
        $this->generators[$language] = $generator;
    }

    /**
     * @param string $language
     * @param string $apiName
     * @param string $namespace
     * @param string $ramlDir
     * @param string $outputDir
     *
     * @throws InvalidApiNameException
     * @throws UnrecognizedTypeException
     */
    public function generateCode(
        string $language,
        string $apiName,
        string $namespace,
        string $ramlDir,
        string $outputDir
    ) {
        if (!isset($this->generators[$language])) {
            throw new UnrecognizedTypeException(sprintf('Cannot generate Code in %s language', $language));
        }

        $ramlFile = sprintf('%s/%s/api.raml', $ramlDir, $apiName);
        if (!$this->filesystem->exists($ramlFile)) {
            throw new InvalidApiNameException(sprintf('Cannot find "%s" file', $ramlFile));
        }

        $apiDefinition = $this->definitionTransformer->decorate(
            $this->ramlParser->parse($ramlFile),
            $apiName,
            $namespace
        );

        $sourceFiles = $this->generators[$language]->generate($apiDefinition);

        foreach ($sourceFiles as $item) {
            $this->filesystem->dumpFile(
                sprintf('%s/%s/%s', $outputDir, $apiName, $item->getFilepath()),
                $item->getContents()
            );
        }
    }
}
